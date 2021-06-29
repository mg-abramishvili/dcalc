<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function partners()
    {
        return Partner::all();
    }

    public function partners_store(Request $request)
    {
        $data = request()->all();
        $partner = new Partner();
        $partner->name = $data['name'];
        $partner->inn = $data['inn'];
        $partner->phone = $data['phone'];
        $partner->email = $data['email'];
        $partner->save();
    }

}
