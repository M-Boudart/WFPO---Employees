<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Behavior\InitialisableBehavior;

/**
 * Employees Model
 *
 * @method \App\Model\Entity\Employee newEmptyEntity()
 * @method \App\Model\Entity\Employee newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EmployeesTable extends Table
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
        
        $this->addBehavior('Initialisable');    //Permet de générer les initiales

        $this->setTable('employees');
        $this->setDisplayField('emp_no');
        $this->setPrimaryKey('emp_no');
        
        $this->hasMany('Salaries', [
            'joinTable' => 'salaries',
            'foreignKey' => 'emp_no',
            'bindingKey' => 'emp_no',
        ]);
        
        $this->hasMany('Employee_title', [
            'joinTable' => 'employee_title',
            'foreignKey' => 'emp_no',
            'bindingKey' => 'emp_no',
        ]);
        
        $this->hasMany('Dept_emp',[
            'joinTable' => 'dept_emp',
            'foreignKey' => 'emp_no',
            'bindingKey' => 'emp_no',
        ]);

        $this->belongsTo('Dept_manager',[
            'joinTable' => 'dept_manager',
            'foreignKey' => 'emp_no',
            'bindingKey' => 'emp_no',
        ]);

        $this->hasMany('Demands',[
            'joinTable' => 'demands',
            'foreignKey' => 'emp_no',
            'bindingKey' => 'emp_no',
        ]);

        $this->belongsTo('Departments', [
            'joinTable' => 'departments',
            'foreignKey' => 'emp_no',
            'bindingKey' => 'emp_no',
        ]);

        $this->belongsToMany('Titles', [
            'joinTable' => 'title',
            'foreignKey' => 'emp_no',
            'bindingKey' => 'emp_no',
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
            ->date('birth_date')
            ->requirePresence('birth_date', 'create')
            ->notEmptyDate('birth_date');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 14)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 16)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->scalar('gender')
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender')
            ->add('gender', 'validValue',[
                'rule' => ['inlist',['F','M', 'X']],
                'message' => 'This value must be either F, M or X',
            ]);

        $validator
            ->date('hire_date')
            ->requirePresence('hire_date', 'create')
            ->notEmptyDate('hire_date');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->requirePresence('picture', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create');

        return $validator;
    }
    
    function findSpecialSearch(Query $query, array $options) {
        $query->where([]);
        
        return $query;
    }
    
    //Récupérer tous les employés d'un département donné
    
    //Recupérer les département de plus de 100 employes qui ne travaillent plus dans ce département
}
