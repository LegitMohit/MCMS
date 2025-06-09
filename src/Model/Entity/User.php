<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity
{
    protected $_accessible = [
        'userId' => false,
        'userName' => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'created' => true,
        'modified' => true
    ];

    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        if ($password) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($password);
        }
    }
} 