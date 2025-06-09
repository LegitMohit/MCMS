<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Patient extends Entity
{
    protected $_accessible = [
        'Patient_id' => false, // Primary key should not be mass assignable
        'first_name' => true,
        'last_name' => true,
        'phone' => true,
        'date_of_birth' => true,
        'address' => true,
        'medical_history' => true,
        'userId' => true,
        '*' => false,  // Don't make any other fields mass assignable by default
    ];
} 