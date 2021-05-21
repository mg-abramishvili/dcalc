<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Calculation;
use Brick\Math\Internal\Calculator;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        return Offer::orderBy('created_at', 'desc')->get();
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $offer = new Offer();
        $offer->comment = $data['comment'];
        $offer->client = $data['client'];
        $offer->save();
        $offer->calculations()->attach($request->calculations, ['offer_id' => $offer->id]);
    }

    public function show($id)
    {
        return Offer::with('calculations')->find($id);
    }
}