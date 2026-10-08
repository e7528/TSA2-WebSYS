<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateDemoLogin extends Migration
{
    public function up(): void
    {
        // Covers an existing TSA2 demo account without changing its tasks.
        $this->db->table('users')->where('username', 'alexrivera')->update([
            'username' => 'admin_reign',
            'password' => password_hash('Admin123!', PASSWORD_BCRYPT),
        ]);
    }

    public function down(): void
    {
        // A credential rotation is intentionally not reversed.
    }
}
