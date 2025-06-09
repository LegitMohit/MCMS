<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        
        $this->setTable('users');
        $this->setDisplayField('email');
        $this->setPrimaryKey('userId');
        
        $this->addBehavior('Timestamp');
        
        $this->setEntityClass('User');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', 'Email is required')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Email already exists']);

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Password is required')
            ->minLength('password', 6, 'Password must be at least 6 characters long');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role', 'Role is required')
            ->inList('role', ['admin', 'doctor', 'patient'], 'Invalid role');

        return $validator;
    }
}
