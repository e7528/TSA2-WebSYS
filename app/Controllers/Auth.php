<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function login(): string|RedirectResponse
    {
        if (session()->has('user_id')) {
            return redirect()->to(site_url('tasks'));
        }

        return view('login', [
            'pageTitle' => 'Sign in',
            'activePage' => 'login',
            'error' => null,
            'username' => '',
        ]);
    }

    public function authenticate(): string|RedirectResponse
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = (new UserModel())->where('username', $username)->first();

        if ($username === '' || $password === '' || $user === null || ! password_verify($password, $user['password'])) {
            $this->response->setStatusCode(422);
            return view('login', [
                'pageTitle' => 'Sign in',
                'activePage' => 'login',
                'error' => 'Invalid username or password.',
                'username' => $username,
            ]);
        }

        session()->regenerate(true);
        session()->set('user_id', (int) $user['id']);
        session()->set('display_name', $user['full_name']);

        return redirect()->to(site_url('tasks'));
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to(site_url('/'));
    }
}
