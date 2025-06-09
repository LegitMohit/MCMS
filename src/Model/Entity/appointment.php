<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Appointment extends Entity
{
    protected $_accessible = [
        'appointment_id' => false,
        'userId' => true,
        'Patient_id' => true,
        'doctor_id' => true,
        'appointment_date' => true,
        'status' => true,
        'notes' => true,
        'created' => true,
        'modified' => true,
        '*' => false,
    ];
} 
