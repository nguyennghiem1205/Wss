<?php
namespace App\Model\Table;

use App\Model\Entity\CeoInfo;
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
class CeoInfoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('ceo_info');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('position_eng');
        $validator->notEmpty('position_jpn');
        $validator->notEmpty('position_vie');
        $validator->notEmpty('type');
        $validator->notEmpty('comment_eng');
        $validator->notEmpty('comment_jpn');
        $validator->notEmpty('comment_vie');
        $validator->notEmpty('image');
        return $validator;
    }

    public function beforeSave(Event $event, Entity $entity)
    {
        // Not hash here anymore because cannot catch the ['new']
        //$entity->password = Security::hash($entity->password, 'sha1', true);
    }
}