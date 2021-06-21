<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projects()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        //
    }
}
