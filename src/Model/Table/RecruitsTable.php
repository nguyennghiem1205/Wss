<?php
namespace App\Model\Table;

use App\Model\Entity\Recruit;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Recruits Model
 *
 */
class RecruitsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('recruits');
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
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title_eng', 'create')
            ->notEmpty('title_eng');

        $validator
            ->requirePresence('title_jpn', 'create')
            ->notEmpty('title_jpn');

        $validator
            ->requirePresence('title_vie', 'create')
            ->notEmpty('title_vie');

        $validator
            ->requirePresence('content_eng', 'create')
            ->notEmpty('content_eng');

        $validator
            ->requirePresence('content_jpn', 'create')
            ->notEmpty('content_jpn');

        $validator
            ->requirePresence('content_vie', 'create')
            ->notEmpty('content_vie');

        $validator
            ->requirePresence('position', 'create')
            ->notEmpty('position');

        $validator
            ->add('number', 'valid', ['rule' => 'numeric'])
            ->requirePresence('number', 'create')
            ->notEmpty('number');

        $validator
            ->add('active', 'valid', ['rule' => 'numeric'])
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }
}
