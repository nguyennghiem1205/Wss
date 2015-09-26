<?php
namespace App\Model\Table;

use App\Model\Entity\FrontendMenu;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\Entity;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Facebooks
 */
class FrontendMenusTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('frontend_menus');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree', ['level' => 'level']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('name_eng');
        $validator->notEmpty('name_jpn');
        $validator->notEmpty('name_vie');
        $validator->notEmpty('description_eng');
        $validator->notEmpty('description_jpn');
        $validator->notEmpty('description_vie');
        return $validator;
    }

    public function beforeSave(Event $event, Entity $entity)
    {
        // Not hash here anymore because cannot catch the ['new']
        //$entity->password = Security::hash($entity->password, 'sha1', true);
    }
}