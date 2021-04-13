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

        $elements = $request->input('formElements', []);
        $amounts = $request->input('formAmounts', []);
        $prices = $request->input('formPrices', []);
        
        for ($element=0; $element < count($elements); $element++) {
            if ($elements[$element] != '') {
                $calculation->elements()->attach($elements[$element], [
                    'amount' => $amounts[$element],
                    'price' => $prices[$element]
                ]);
            }
        }
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
