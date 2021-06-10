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

    public function box_edit(Request $request)
    {
        $rules = [
            'title' => 'required',
            'pre_rub' => 'required|numeric',
            'pre_usd' => 'required|numeric',
            'price' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $box = Box::find($data['id']);
        $box->title = $data['title'];
        $box->pre_rub = $data['pre_rub'];
        $box->pre_usd = $data['pre_usd'];
        $box->price = $data['price'];
        $box->save();
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
