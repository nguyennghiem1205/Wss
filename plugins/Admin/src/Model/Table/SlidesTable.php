<?php
namespace Admin\Model\Table;

use Admin\Model\Entity\Slide;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Slides Model
 *
 */
class SlidesTable extends Table
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

        $this->table('slides');
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
            ->requirePresence('name_vie', 'create')
            ->notEmpty('name_vie');

        $validator
            ->requirePresence('name_eng', 'create')
            ->notEmpty('name_eng');

        $validator
            ->requirePresence('name_jpn', 'create')
            ->notEmpty('name_jpn');

        $validator
            ->requirePresence('description_vie', 'create')
            ->notEmpty('description_vie');

        $validator
            ->requirePresence('description_eng', 'create')
            ->notEmpty('description_eng');

        $validator
            ->requirePresence('description_jpn', 'create')
            ->notEmpty('description_jpn');
        $validator
            ->requirePresence('content_vie', 'create')
            ->notEmpty('content_vie');

        $validator
            ->requirePresence('content_eng', 'create')
            ->notEmpty('content_eng');

        $validator
            ->requirePresence('content_jpn', 'create')
            ->notEmpty('content_jpn');

        $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->add('active', 'valid', ['rule' => 'numeric'])
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        return $validator;
    }
}
