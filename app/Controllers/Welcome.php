<?php

namespace App\Controllers;

use App\Models\TaskModel;
use Config\App;
use DateTimeImmutable;
use DateTimeZone;

class Welcome extends BaseController
{
    public function index(): string
    {
        // Both the dashboard and seed data use the configured local day.
        $today = (new DateTimeImmutable('now', new DateTimeZone(config(App::class)->appTimezone)))
            ->format('Y-m-d');
        $tasks = (new TaskModel())->forDate($today);

        return view('welcome', [
            'pageTitle' => 'Today',
            'activePage' => 'today',
            'today'      => $today,
            'tasks'      => $tasks,
            'completed'  => count(array_filter($tasks, static fn (array $task): bool => $task['status'] === 'completed')),
            'pending'    => count(array_filter($tasks, static fn (array $task): bool => $task['status'] === 'pending')),
        ]);
    }
}
