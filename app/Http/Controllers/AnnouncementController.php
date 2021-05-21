<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return Announcement::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $announcement = new Announcement();
        $announcement->text = $data['text'];
        $announcement->save();
        //$offer->calculations()->attach($request->calculations, ['offer_id' => $offer->id]);
    }
}
