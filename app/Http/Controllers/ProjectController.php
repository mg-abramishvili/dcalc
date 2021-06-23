<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Offer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projects()
    {
        return Project::orderBy('created_at', 'desc')->get();
    }

    public function project_item($id)
    {
        return Project::with('calculations.boxes', 'calculations.elements.categories', 'offers.calculations.elements')->find($id);
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
        $offer = new Offer([
            'client' => '',
            'comment' => '',
        ]);
        $offer->save();
        $offer->calculations()->attach($request->calculation_id, ['offer_id' => $offer->id]);
        $project->calculations()->attach($request->calculation_id, ['project_id' => $project->id]);
        $project->offers()->attach($offer->id, ['project_id' => $project->id]);
    }
}
