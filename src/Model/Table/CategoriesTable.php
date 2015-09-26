<?php
namespace App\Model\Table;

use App\Model\Entity\Category;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\Entity;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\ORM\Behavior\TreeBehavior;
/**
 * Users Model
 *
 */
class CategoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('categories');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');
        $this->hasMany('News');
//        $this->hasMany ('News', [
//            'foreignKey' => 'id'
//        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('title_eng');
        $validator->notEmpty('title_jpn');
        $validator->notEmpty('title_vie');

        $validator->notEmpty('description_eng');
        $validator->notEmpty('description_jpn');
        $validator->notEmpty('description_vie');

        $validator->notEmpty('content_eng');
        $validator->notEmpty('content_jpn');
        $validator->notEmpty('content_vie');

        return $validator;
    }
    public function beforeSave(Event $event, Entity $entity)
    {
        // Not hash here anymore because cannot catch the ['new']
        //$entity->password = Security::hash($entity->password, 'sha1', true);
    }
}