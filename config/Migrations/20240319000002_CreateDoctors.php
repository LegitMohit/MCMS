<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateDoctors extends AbstractMigration
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
        $table = $this->table('doctors', [
            'id' => false,
            'primary_key' => ['doctor_id']
        ]);

        $table->addColumn('doctor_id', 'integer', [
            'autoIncrement' => true,
            'null' => false,
        ])
        ->addColumn('userId', 'integer', [
            'null' => false,
        ])
        ->addColumn('first_name', 'string', [
            'limit' => 100,
            'null' => true,
        ])
        ->addColumn('last_name', 'string', [
            'limit' => 100,
            'null' => true,
        ])
        ->addColumn('specialization', 'string', [
            'limit' => 100,
            'null' => true,
        ])
        ->addColumn('phone', 'string', [
            'limit' => 15,
            'null' => true,
        ])
        ->addColumn('availability_hours', 'string', [
            'limit' => 100,
            'null' => true,
        ])
        ->addForeignKey('userId', 'users', 'userId', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ])
        ->create();
    }
} 