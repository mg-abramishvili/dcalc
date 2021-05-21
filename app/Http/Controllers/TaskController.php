<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $task = new Task();
        $task->task = $data['task'];
        $task->save();
        //$offer->calculations()->attach($request->calculations, ['offer_id' => $offer->id]);
    }

}
