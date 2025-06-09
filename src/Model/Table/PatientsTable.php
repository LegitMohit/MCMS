<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PatientsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('patients');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('Patient_id');

        $this->addBehavior('Timestamp');  // Adds automatic timestamp handling

        // Add any relationships here if needed
        // For example:
        // $this->belongsTo('Users');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('Patient_id')
            ->allowEmptyString('Patient_id', null, 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name', 'First name is required');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name', 'Last name is required');

        $validator
            ->integer('phone')
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone')
            ->add('phone', [
                'length' => [
                    'rule' => ['lengthBetween', 10, 10],
                    'message' => 'Phone number must be exactly 10 digits'
                ],
                'numeric' => [
                    'rule' => 'numeric',
                    'message' => 'Phone number must contain only numbers'
                ]
            ]);

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmptyDate('date_of_birth', 'Date of birth is required');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address', 'Address is required');

        $validator
            ->scalar('medical_history')
            ->allowEmptyString('medical_history');

        $validator
            ->integer('userId')
            ->notEmptyString('userId', 'User ID is required');

        return $validator;
    }
} 
