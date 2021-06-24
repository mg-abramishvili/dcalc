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

    public function file_upload(Request $request)
    {
        if ($request->hasFile('box_images')) {
            $file = $request->file('box_images');
            /*$filename = $file->getClientOriginalName();
            $folder = \Carbon\Carbon::now()->format('Y-m-d');
            $file->storeAs('tmp_uploads/' . $folder, $filename);
            return $folder;*/
            $filename = md5(time() . rand(1, 100000)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads', $filename);
            return \Response::make('/uploads/' . $filename, 200, [
                'Content-Disposition' => 'inline',
            ]);
        }
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
        //$box->box_images = $data['box_images'];
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
        //$box->box_images = $data['box_images'];
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
