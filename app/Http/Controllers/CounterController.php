<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function user_count()
    {
        return User::count() - 1;
    }

    public function project_count()
    {
        return Project::count();
    }

    public function client_count()
    {
        return Client::count();
    }
}
