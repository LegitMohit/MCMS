<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Doctor extends Entity
{
    protected $_accessible = [
        'doctor_id' => false, // Primary key should not be mass assignable
        'first_name' => true,
        'last_name' => true,
        'phone' => true,
        'specialization' => true,
        'availability_hours' => true,
        'userId' => true,
        '*' => false,  // Don't make any other fields mass assignable by default
    ];
} 