<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateAppointments extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('appointments', [
            'id' => false,
            'primary_key' => ['appointment_id']
        ]);

        $table->addColumn('appointment_id', 'integer', [
            'autoIncrement' => true,
            'null' => false,
        ])
        ->addColumn('Patient_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('doctor_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('appointment_date', 'datetime', [
            'null' => false,
        ])
        ->addColumn('status', 'string', [
            'limit' => 50,
            'null' => true,
        ])
        ->addColumn('notes', 'text', [
            'null' => true,
        ])
        ->addColumn('created', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'update' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->addForeignKey('Patient_id', 'patients', 'Patient_id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ])
        ->addForeignKey('doctor_id', 'doctors', 'doctor_id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ])
        ->create();
    }
} 