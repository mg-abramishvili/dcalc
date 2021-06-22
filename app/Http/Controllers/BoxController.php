<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function boxes()
    {
        return Box::with('types')->get();
    }

    public function boxes_filter($type_id, Request $request)
    {
        return Box::with('types')->whereHas('types', function ($query) use($type_id) {
            return $query->where('type_id', '=', $type_id);
        })->get();
    }

    public function boxes_store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'pre_rub' => 'required|numeric',
            'pre_usd' => 'required|numeric',
            'marzha' => 'required|numeric',
            'sborka' => 'required|numeric',
            'price' => 'required|numeric',
            'types' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $box = new Box();
        $box->title = $data['title'];
        $box->pre_rub = $data['pre_rub'];
        $box->pre_usd = $data['pre_usd'];
        $box->marzha = $data['marzha'];
        $box->sborka = $data['sborka'];
        $box->price = $data['price'];
        $box->length = $data['length'];
        $box->width = $data['width'];
        $box->height = $data['height'];
        $box->weight = $data['weight'];
        $box->description = $data['description'];
        $box->descriptionmanager = $data['descriptionmanager'];
        $box->save();
        $box->types()->attach($request->types, ['box_id' => $box->id]);
    }

    public function box_edit(Request $request)
    {
        $rules = [
            'title' => 'required',
            'pre_rub' => 'required|numeric',
            'pre_usd' => 'required|numeric',
            'marzha' => 'required|numeric',
            'sborka' => 'required|numeric',
            'price' => 'required|numeric',
            'types' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $box = Box::find($data['id']);
        $box->title = $data['title'];
        $box->pre_rub = $data['pre_rub'];
        $box->pre_usd = $data['pre_usd'];
        $box->marzha = $data['marzha'];
        $box->sborka = $data['sborka'];
        $box->price = $data['price'];
        $box->length = $data['length'];
        $box->width = $data['width'];
        $box->height = $data['height'];
        $box->weight = $data['weight'];
        $box->description = $data['description'];
        $box->descriptionmanager = $data['descriptionmanager'];
        $box->save();
        $box->types()->detach();
        $box->types()->attach($request->types, ['box_id' => $box->id]);
    }

    public function box_item($id, Request $request)
    {
        return Box::with('types')->find($id);
    }

    public function box_delete($id)
    {
        $box = Box::find($id);
        $box->delete();
        $box->types()->detach();
    }
}
