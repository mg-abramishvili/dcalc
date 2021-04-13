<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Brick\Math\Internal\Calculator;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function index()
    {
        return Calculation::orderBy('created_at', 'desc')->get();
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $calculation = new Calculation();
        $calculation->comment = $data['formComment'];
        $calculation->save();

        $calculation->elements()->attach($data['formElement'],
            [
                'amount' => $data['formAmount'],
                'price' => $data['formPrice']
            ]
        );
    }

    public function show($id)
    {
        return Calculation::with('elements')->find($id);
    }

    public function edit(Calculation $calculation)
    {
        //
    }

    public function update(Request $request, Calculation $calculation)
    {
        //
    }

    public function destroy(Calculation $calculation)
    {
        //
    }
}
