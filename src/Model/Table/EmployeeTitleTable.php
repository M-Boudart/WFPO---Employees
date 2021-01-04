<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeTitle Model
 *
 * @method \App\Model\Entity\EmployeeTitle newEmptyEntity()
 * @method \App\Model\Entity\EmployeeTitle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTitle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTitle get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeTitle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EmployeeTitle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTitle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeTitle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeTitle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeTitle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeTitle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeTitle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EmployeeTitle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EmployeeTitleTable extends Table
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

        $this->setTable('employee_title');
        $this->setDisplayField('emp_no');
        $this->setPrimaryKey(['emp_no', 'title_no', 'from_date']);

        $this->belongsToMany('Titles', [
            'joinTable' => 'titles',
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
            ->integer('emp_no')
            ->allowEmptyString('emp_no', null, 'create');

        $validator
            ->integer('title_no')
            ->allowEmptyString('title_no', null, 'create');

        $validator
            ->date('from_date')
            ->allowEmptyDate('from_date', null, 'create');

        $validator
            ->date('to_date')
            ->allowEmptyDate('to_date');

        return $validator;
    }
}
