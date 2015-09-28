<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Core;

/**
 * Menu helper
 */
class MenuHelper extends Helper
{
    public $helpers=['Url'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    function getLink($link=null)
    {
        //get id
        $id=explode('&wss$',$link);
        if(count($id)>1){
            $id=explode('=',$id[0]);
            if(count($id)>1)$id=$id[1];
        }
        //get name
        $name=explode('&wss$',$link);
        if(count($name)>1){
            $name=explode('=',$name[1]);
            if(count($name)>1)$name=$name[1];
        }
        if (strpos($link, 'siteid') !== false)
            return Core::generateUrl([
                'controller'=>'Pages',
                'action'=>'view',
                'name' => $name,
                'id' => $id
            ]);
        if (strpos($link, 'catid') !== false)
            return Core::generateUrl([
                'controller'=>'News',
                'action'=>'category',
                'name' => $name,
                'id' => $id
            ]);
        if($link=='contact')return $this->Url->build(['controller'=>'Pages','action'=>'contact']);
        if($link=='recruitment')return $this->Url->build(['controller'=>'Pages','action'=>'recruitment']);
        return $link;
    }
    function checkChildren($bo,$con){
        foreach($con as $item){
            if($item['parent_id']==$bo)return true;
        }
        return false;

    }

}
