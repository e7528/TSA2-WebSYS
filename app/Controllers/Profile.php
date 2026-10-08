<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index(): string
    {
        return view('profile', [
            'pageTitle'  => 'Profile',
            'activePage' => 'profile',
            'user'       => (new UserModel())->select('id, username, full_name, email, created_at')->first(),
        ]);
    }
}
