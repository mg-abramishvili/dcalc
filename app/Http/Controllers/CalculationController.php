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

        $calculation->types()->attach($request->types, ['calculation_id' => $calculation->id]);
        $calculation->boxes()->attach($request->boxes, ['calculation_id' => $calculation->id]);

        return $calculation->id;
        
        $elements = $request->input('elements', []);
        
        for ($element=0; $element < count($elements); $element++) {
            if ($elements[$element] != '') {
                $calculation->elements()->attach($elements[$element], []);
            }
        }
    }

    public function edit(Request $request)
    {
        $data = request()->all();
        $calculation = Calculation::find($data['id']);
        $calculation->comment = $data['comment'];
        $calculation->price_total = $data['price_total'];
        $calculation->save();

        $calculation->types()->detach();
        $calculation->types()->attach($request->types, ['calculation_id' => $calculation->id]);
        $calculation->boxes()->detach();
        $calculation->boxes()->attach($request->boxes, ['calculation_id' => $calculation->id]);

        $calculation->elements()->detach();

        $elements = $request->input('elements', []);

        for ($element=0; $element < count($elements); $element++) {
            if ($elements[$element] != '') {
                $calculation->elements()->attach($elements[$element], [
                    //'amount' => '1',
                ]);
            }
        }
    }

    public function show($id)
    {
        return Calculation::with('elements.categories', 'boxes', 'types')->find($id);
    }

}
