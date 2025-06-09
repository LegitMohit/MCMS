<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AppointmentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        
        $this->setTable('appointments');
        $this->setDisplayField('appointment_id');
        $this->setPrimaryKey('appointment_id');
        
        $this->addBehavior('Timestamp');
        
        $this->setEntityClass('Appointment');
        
        // Add relationship with Patients
        $this->belongsTo('Patients', [
            'foreignKey' => 'Patient_id',
            'joinType' => 'LEFT'
        ]);
        
        // Add relationship with Doctors
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id',
            'joinType' => 'LEFT'
        ]);
        
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('appointment_id')
            ->allowEmptyString('appointment_id', null, 'create');
            
        $validator
            ->integer('userId')
            ->notEmptyString('userId', 'User ID is required');

        $validator
            ->integer('Patient_id')
            ->maxLength('Patient_id', 255)
            ->requirePresence('Patient_id', 'create')
            ->notEmptyString('Patient_id', 'Patient ID is required');

        $validator
            ->integer('doctor_id')
            ->maxLength('doctor_id', 255)
            ->requirePresence('doctor_id', 'create')
            ->notEmptyString('doctor_id', 'Doctor ID is required');

        $validator
            ->date('appointment_date')
            ->requirePresence('appointment_date', 'create')
            ->notEmptyDate('appointment_date', 'Appointment date is required');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status', 'Status is required')
            ->inList('status', ['Pending', 'Done'], 'Status must be either Pending or Done');

        $validator
            ->scalar('notes')
            ->requirePresence('notes', 'create')
            ->notEmptyString('notes', 'Notes is required');

        
        return $validator;
    }
}
