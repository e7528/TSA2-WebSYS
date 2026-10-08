<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthenticationAndArchiving extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('tasks', [
            'is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'null' => false],
        ]);
        // Nullable during the upgrade so existing TSA1 users can be backfilled.
        $this->forge->addColumn('users', [
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->db->table('users')->where('password', null)->update([
            'password' => password_hash('Admin123!', PASSWORD_BCRYPT),
        ]);
        $this->forge->modifyColumn('users', [
            'password' => ['name' => 'password', 'type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('users', 'password');
        $this->forge->dropColumn('tasks', 'is_archived');
    }
}
