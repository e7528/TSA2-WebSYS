<?php

namespace App\Controllers;

use Config\Project;

class About extends BaseController
{
    public function index(): string
    {
        return view('about', [
            'pageTitle'  => 'About',
            'activePage' => 'about',
            'developer'  => config(Project::class)->developerName,
        ]);
    }
}
