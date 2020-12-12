<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Titles Model
 *
 * @method \App\Model\Entity\Title newEmptyEntity()
 * @method \App\Model\Entity\Title newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Title[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Title get($primaryKey, $options = [])
 * @method \App\Model\Entity\Title findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Title patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Title[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Title|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Title saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Title[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Title[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Title[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Title[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TitlesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('titles');
        $this->setDisplayField('title');
        $this->setPrimaryKey(['emp_no', 'title', 'from_date']);

        $this->hasMany('Vacancies', [
            'joinTable' => 'vacancies',
            'foreignKey' => 'title_no',
            'bindingKey' => 'title_no',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('title_no')
            ->allowEmptyString('title_no', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }
}
