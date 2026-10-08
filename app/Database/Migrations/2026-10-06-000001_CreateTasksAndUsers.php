<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksAndUsers extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => false],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'pending', 'null' => false],
            'task_date'  => ['type' => 'DATE', 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tasks');

        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'full_name'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users');
    }

    public function down(): void
    {
        $this->forge->dropTable('users');
        $this->forge->dropTable('tasks');
    }
}
