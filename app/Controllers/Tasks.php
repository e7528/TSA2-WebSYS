<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\App;
use DateTimeImmutable;
use DateTimeZone;

class Tasks extends BaseController
{
    public function index(): string
    {
        return view('tasks', [
            'pageTitle' => 'All tasks',
            'activePage' => 'tasks',
            'tasks' => (new TaskModel())->allByDate(),
        ]);
    }

    public function new(): string
    {
        return $this->form('New task', 'new', null, [
            'title' => '', 'status' => 'pending',
            'task_date' => (new DateTimeImmutable('now', new DateTimeZone(config(App::class)->appTimezone)))->format('Y-m-d'),
        ]);
    }

    public function create(): string|RedirectResponse
    {
        $data = $this->input();
        if (! $this->validateData($data, $this->rules())) {
            $this->response->setStatusCode(422);
            return $this->form('New task', 'new', null, $data, $this->validator->getErrors());
        }

        $data = $this->validator->getValidated();
        $data['created_at'] = (new DateTimeImmutable('now', new DateTimeZone(config(App::class)->appTimezone)))->format('Y-m-d H:i:s');
        (new TaskModel())->insert($data);
        return redirect()->to(site_url('tasks'))->with('notice', 'Task created.');
    }

    public function edit(int $id): string
    {
        $task = $this->activeTask($id);
        return $this->form('Edit task', 'edit', $id, $task);
    }

    public function update(int $id): string|RedirectResponse
    {
        $this->activeTask($id);
        $data = $this->input();
        if (! $this->validateData($data, $this->rules())) {
            $this->response->setStatusCode(422);
            return $this->form('Edit task', 'edit', $id, $data, $this->validator->getErrors());
        }

        (new TaskModel())->update($id, $this->validator->getValidated());
        return redirect()->to(site_url('tasks'))->with('notice', 'Task updated.');
    }

    public function archive(int $id): RedirectResponse
    {
        $this->activeTask($id);
        (new TaskModel())->update($id, ['is_archived' => 1]);
        return redirect()->to(site_url('tasks'))->with('notice', 'Task archived.');
    }

    private function activeTask(int $id): array
    {
        return (new TaskModel())->findActive($id) ?? throw PageNotFoundException::forPageNotFound();
    }

    private function input(): array
    {
        return [
            'title' => trim((string) $this->request->getPost('title')),
            'status' => (string) $this->request->getPost('status'),
            'task_date' => (string) $this->request->getPost('task_date'),
        ];
    }

    private function rules(): array
    {
        return [
            'title' => 'required|max_length[150]',
            'status' => 'required|in_list[pending,in_progress,completed]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];
    }

    private function form(string $title, string $mode, ?int $id, array $task, array $errors = []): string
    {
        return view('task_form', [
            'pageTitle' => $title,
            'activePage' => 'tasks',
            'mode' => $mode,
            'id' => $id,
            'task' => $task,
            'errors' => $errors,
        ]);
    }
}
