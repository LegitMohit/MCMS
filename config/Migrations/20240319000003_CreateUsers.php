<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users', [
            'id' => false,
            'primary_key' => ['userId']
        ]);

        $table->addColumn('userId', 'integer', [
            'limit' => 11,
            // 'autoIncrement' => true,
            'null' => false,
        ])
        ->addColumn('userName', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('email', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('password', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('role', 'string', [
            'limit' => 50,
            'null' => false,
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
        ->create();
    }
} 