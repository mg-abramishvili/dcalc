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

    public function index_count()
    {
        return Calculation::orderBy('created_at', 'desc')->count();
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $calculation = new Calculation();
        $calculation->comment = $data['comment'];
        $calculation->price_total = $data['price_total'];
        $calculation->save();

        $elements = $request->input('elements', []);
        
        for ($element=0; $element < count($elements); $element++) {
            if ($elements[$element] != '') {
                $calculation->elements()->attach($elements[$element], [
                    'amount' => '1',
                    'price' => '0'
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
