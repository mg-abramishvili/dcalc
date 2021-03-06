<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\Element;
use Brick\Math\Internal\Calculator;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function index()
    {
        return Calculation::orderBy('created_at', 'desc')->with('users', 'boxes')->get();
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

        $calculation->users()->attach($request->user, ['calculation_id' => $calculation->id]);

        $calculation->types()->attach($request->type, ['calculation_id' => $calculation->id]);
        $calculation->boxes()->attach($request->box, ['calculation_id' => $calculation->id]);
        
        $elements = $request->input('elements', []);
        
        for ($element=0; $element < count($elements); $element++) {
            if ($elements[$element] != '') {
                $el = Element::find($elements[$element]);
                $calculation->elements()->attach($elements[$element], [
                    'price' => $el->price,
                ]);
            }
        }

        return $calculation->id;
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
        return Calculation::with('elements.categories', 'boxes', 'types', 'users', 'offers')->find($id);
    }

}
