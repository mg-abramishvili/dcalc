<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Offer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projects()
    {
        return Project::with('users')->orderBy('created_at', 'desc')->get();
    }

    public function project_item($id)
    {
        return Project::with('calculations.boxes', 'calculations.elements.categories', 'offers.calculations.elements', 'users', 'endclients', 'partners')->find($id);
    }

    public function projects_search($search, Request $request)
    {
        return Project::where('name', 'LIKE', "%$search%")->get();
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
        $project->offers()->attach($request->offer_id, ['project_id' => $project->id]);
        $project->users()->attach($request->users, ['project_id' => $project->id]);
        $project->endclients()->attach($request->endclient, ['project_id' => $project->id]);
    }
}
