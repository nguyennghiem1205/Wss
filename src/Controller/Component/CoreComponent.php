<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * Core component
 * @property mixed Settings
 */
class CoreComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function initialize(array $config) 
    {
        parent::initialize($config);
    }
    
    /**
     * save email to stack and be sent by cron job
     * @throws Exception
     * @param int $templateID : The template ID hardcode by the system
     * @param array $option : $option[email] is required (it's the email of the receiver)
     * @return void
     */
    function saveEmailStack($templateID,$option)
    {
        $this->EmailTemplates = TableRegistry::get('EmailTemplates');
        $this->EmailStacks = TableRegistry::get('EmailStacks');
        
        $template = $this->EmailTemplates->find()
                        ->where(['id'=>$templateID])
                        ->first();
                
        /* ---------- Info { ---------- */
        $content = $template->content;
        
        if($option)
        {
            foreach($option as $key => $value)
            {
                $content = str_replace('['.$key.']',$value,$content);
            }
        }
        /* ---------- Info } ---------- */
        
        // Save stack
        $data = [
            'email'=>$option['email'],
            'subject'=>$template->subject,
            'content'=>$content,
            'created'=>date('Y-m-d H:i:s')
        ];
        
        $emaiStackEntity = $this->EmailStacks->newEntity();
        $emaiStackEntity = $this->EmailStacks->patchEntity($emaiStackEntity, $data);
        return $this->EmailStacks->save($emaiStackEntity);
    }
    
    public function getResources($pluginName=null)
    {
        if(!empty($pluginName))
        {
            $path = \Cake\Core\Plugin::path($pluginName);
        }
        else
        {
            $path = ROOT.DS;
        }
        
        $path .= 'src' . DS . 'Controller';
        if(file_exists($path))
        {
            $controllers = $this->getControllers($path);                
            $resources = [];
            foreach($controllers as $controller)
            {
                $actions = $this->getActions($controller,$pluginName);
                $resources[$controller] = $actions;
            }
            return $resources;
        }
        
        return null;
    }
    
    public function getControllers($path) 
    {
        $files = scandir($path);
        $results = [];
        $ignoreList = [
            '.', 
            '..', 
            'Component', 
            'AppController.php',
        ];
        foreach($files as $file)
        {
            if(!in_array($file, $ignoreList)) 
            {
                $controller = explode('.', $file)[0];
                array_push($results, str_replace('Controller', '', $controller));
            }            
        }
        
        return $results;
    }
    
    public function getActions($controllerName,$pluginName=null) 
    {
        if(empty($pluginName))
        {
            $pluginName = 'App';
        }
                   
        $className = $pluginName .'\\Controller\\'.$controllerName.'Controller';
        $class = new \ReflectionClass($className);
        $actions = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
        
        $results = [];
        $ignoreList = ['beforeFilter', 'afterFilter', 'initialize'];
        foreach($actions as $action)
        {
            if($action->class == $className && !in_array($action->name, $ignoreList))
            {
                array_push($results, $action->name);
            }   
        }
        
        return $results;
    }
    
    public function getController() 
    {
        $controllerClasses = \Cake\App::objects('controller');
        foreach($controllerClasses as $controller) 
        { 
            if ($controller != 'AppController') 
            {
                App::uses($controller, 'Controller');
                
                $actions = get_class_methods($controller);
                
                foreach($actions as $k => $v) 
                {
                    if ($v{0} == '_') {
                        unset($actions[$k]);
                    }
                }
                $parentActions = get_class_methods('AppController');
                $controllers[$controller] = array_diff($actions, $parentActions);
            }
        }
        return $controllers;
    }

    /**
     * Customize the cake patchEntity, support the upload, patch the hasmany ...
     * @throws Exception
     * @param string $newEntity : same as default
     * @param string $data : same as default
     * @param string $model : the current Model
     * @return void
     */
    public function patchEntity($newEntity, $data, $model=null)
    {
        if(!$model) $model = $newEntity->source();
        
        $this->$model = TableRegistry::get($model);
        $entity = $this->$model->patchEntity($newEntity, $data);

        /* ---------- Validate and upload hw-file { ---------- */
        $errorTypes = Configure::read('Core.Errors.File');
        if (isset($entity->hw_file_errors) && $entity->hw_file_errors) {

            foreach ($entity->hw_file_errors as $field => $errorType) {
                if (!$entity->isNew() && $errorType == FILE_ERROR_EMPTY) {
                    continue;
                }
                if (array_key_exists($errorType, $errorTypes)) {
                    $messageErrorFile = $errorTypes[$errorType];
                    $entity->errors($field, $messageErrorFile);
                }
            }
        }
        if (!$entity->errors() && $entity->imageFields != NULL) {

            foreach ($entity->imageFields as $field => $params) {
                
                //debug($entity);die();
                
                $fileTmp = $field.'_tmp';
                $file = $entity->$fileTmp;
                if (!$file['tmp_name']) {
                    $entity->$field = null;
                    if (!$entity->isNew()) {
                        unset($entity->$field);
                        continue;
                    }
                    if ($params['required']) {
                        $entity->errors($field, $errorTypes[FILE_ERROR_EMPTY]);
                    }
                    continue;
                }
                if ($file['size'] > $params['size']) {
                    $entity->$field = null;
                    $entity->errors($field, $errorTypes[FILE_ERROR_MAX_SIZE]);
                    continue;
                }
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), array_map('strtolower', $params['extensions']))) {
                    $entity->$field = null;
                    $entity->errors($field, $errorTypes[FILE_ERROR_EXTENSION]);
                    continue;
                }
                $entity->$field = \Core::uploadFile($file, $model);
                unset($entity->$fileTmp);
            }
            unset($entity->hw_file_errors);
        }
        /* ---------- Validate and upload hw-file } ---------- */
        
        
        /* ---------- Patch hasMany { ---------- */
        /*
         * Patch the data and add new item to the hasmany, also delete those old items if no error
         */
        $hasError = false;
        if($entity->errors()) $hasError = true;
        foreach($this->$model->associations()->keys() as $many)
        {
            if(isset($entity->$many))
            {
                /* ---------- Get old IDs { ---------- */
                $oldIDs = [];
                foreach($entity->$many as $item)
                {
                    array_push($oldIDs,$item->id);
                }
                /* ---------- Get old IDs } ---------- */

                $manyModel = TableRegistry::get($many);
                //$entity->$many = $manyModel->patchEntities($entity->$many,$data[$many]); Not good
                $newEntities = $manyModel->newEntities($data[$many]);
                $entity->$many = $newEntities;

                /* ---------- Get new IDs { ---------- */
                $newIDs = [];
                foreach($entity->$many as $item)
                {
                    if($item->errors()) $hasError = true;
                    if($item->id) array_push($newIDs,$item->id);
                }
                /* ---------- Get new IDs } ---------- */

                // Delete hasMany item if no error occur
                if($hasError == false)
                {
                    $deleteIDs = array_diff($oldIDs, $newIDs); // This is those deleted data

                    if($deleteIDs)
                    {
                        $deleteIDs = implode($deleteIDs,',');
                        $manyModel->deleteAll(["id in ($deleteIDs)"]);
                    }
                }
            }
        }
        /* ---------- Patch hasMany } ---------- */
        
        return $entity;
    }
    
    public function getListErrors($entErrors)
    {
        $errors = [];
        if($entErrors)
        {
            foreach($entErrors as $field => $item)
            {
                $errors[$field] = array_values($item)[0];
            }
        }
        
        return $errors;
    }

    public function setting($field)
    {
        $this->Settings = TableRegistry::get('Settings');
        $settings = $this->Settings->find()->first();

        return $settings ? $settings->$field : null;
    }
    public function getLeftMenu($type,$id,&$id_mn=null)
    {
        $parentId=null;
        $menus=TableRegistry::get('FrontendMenus');
        $news=TableRegistry::get('News');
        switch ($type) {
            case 0://category
                $parentId=$menus->find('all', ['fields'=>'parent_id','conditions' => ['active' => 1,'link LIKE'=>'catid='.$id.'%']]);
                $id_mn=$menus->find('all', ['fields'=>'id','conditions' => ['active' => 1,'link LIKE'=>'catid='.$id.'%']])->toArray();
                break;
            case 1://news
                $catid=$news->find('all',['fields'=>'category_id','conditions' => ['id'=>$id]])->toArray()[0];
                $catid=$catid['category_id'];
                $parentId=$menus->find('all', ['fields'=>'parent_id','conditions' => ['active' => 1,'link LIKE'=>'catid='.$catid.'%']]);
                $id_mn=$menus->find('all', ['fields'=>'id','conditions' => ['active' => 1,'link LIKE'=>'catid='.$catid.'%']])->toArray();
                break;
            case 2://pages
                $parentId=$menus->find('all', ['fields'=>'parent_id','conditions' => ['active' => 1,'link LIKE'=>'siteid='.$id.'%']]);
                $id_mn=$menus->find('all', ['fields'=>'id','conditions' => ['active' => 1,'link LIKE'=>'siteid='.$id.'%']])->toArray();
                break;
        }
        return $menus->find('all', ['conditions' => ['active' => 1,'parent_id'=>$parentId]])->toArray();
    }
}