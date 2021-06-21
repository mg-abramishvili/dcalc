<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projects()
    {
        return Project::orderBy('created_at', 'desc')->get();
    }

    public function project_item($id)
    {
        return Project::with('calculations')->find($id);
    }

    public function projects_store(Request $request)
    {
        $data = request()->all();
        $project = new Project();
        $project->name = $data['name'];
        $project->status = $data['status'];
        $project->priority = $data['priority'];
        $project->deadline = $data['deadline'];
        $project->payment = $data['payment'];
        $project->description = $data['description'];
        $project->save();
        $project->calculations()->attach($request->calculation_id, ['project_id' => $project->id]);
    }
}
