<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Config\App;
use DateTimeImmutable;
use DateTimeZone;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $now = new DateTimeImmutable('now', new DateTimeZone(config(App::class)->appTimezone));

        // A fresh database receives exactly one demo user. Re-running the
        // seeder does not duplicate or delete existing records.
        if ($this->db->table('users')->countAllResults() === 0) {
            $this->db->table('users')->insert([
                'username'   => 'admin_reign',
                'full_name'  => 'Adrien Russel Tan',
                'email'      => 'admin_reign@example.com',
                'created_at' => $now->format('Y-m-d H:i:s'),
                'password'   => password_hash('Admin123!', PASSWORD_BCRYPT),
            ]);
        }

        if ($this->db->table('tasks')->countAllResults() !== 0) {
            return;
        }

        // Dates are calculated when seeded, so the dashboard starts with
        // actual tasks for today regardless of the installation date.
        $items = [
            ['Organize project assets',       'completed',   '-2 days'],
            ['Prepare weekly sprint notes',   'completed',   '-1 day'],
            ['Review client feedback',        'completed',   '-1 day'],
            ['Check team inbox',              'completed',   'today'],
            ['Finalize landing page copy',    'in_progress', 'today'],
            ['Review open pull requests',     'pending',     'today'],
            ['Send daily status update',      'pending',     'today'],
            ['Plan next sprint',              'pending',     '+1 day'],
            ['Prepare stakeholder check-in',  'pending',     '+1 day'],
        ];

        $rows = [];
        foreach ($items as $index => [$title, $status, $offset]) {
            $taskDay = $offset === 'today' ? $now : $now->modify($offset);
            $created = $taskDay < $now ? $taskDay->modify('-1 day') : $now;
            $rows[] = [
                'title'      => $title,
                'status'     => $status,
                'task_date'  => $taskDay->format('Y-m-d'),
                'created_at' => $created->modify('-' . (20 - $index) . ' minutes')->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('tasks')->insertBatch($rows);
    }
}
