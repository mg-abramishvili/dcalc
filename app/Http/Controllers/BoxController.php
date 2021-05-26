<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        return Box::with('types')->get();
    }

    public function index_filter($type_id, Request $request)
    {
        return Box::with('types')->whereHas('types', function ($query) use($type_id) {
            return $query->where('type_id', '=', $type_id);
        })->get();
    }
}
