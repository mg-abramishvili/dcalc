<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Category;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function elements()
    {
        return Element::with('categories')->get();
    }

    public function elements_filter_box($box_id, Request $request)
    {
        return Element::with('boxes', 'categories')->whereHas('boxes', function ($query) use($box_id) {
            return $query->where('box_id', '=', $box_id);
        })->get();
    }

    public function elements_store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'pre_rub' => 'required|numeric',
            'pre_usd' => 'required|numeric',
            'price' => 'required|numeric',
            'categories' => 'required',
            'boxes' => 'required',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $element = new Element();
        $element->title = $data['title'];
        $element->pre_rub = $data['pre_rub'];
        $element->pre_usd = $data['pre_usd'];
        $element->price = $data['price'];
        $element->save();
        $element->categories()->attach($request->categories, ['element_id' => $element->id]);
        $element->boxes()->attach($request->boxes, ['element_id' => $element->id]);
    }

    public function element_edit(Request $request)
    {
        $rules = [
            'title' => 'required',
            'pre_rub' => 'required|numeric',
            'pre_usd' => 'required|numeric',
            'price' => 'required|numeric',
            'categories' => 'required',
            'boxes' => 'required',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $element = Element::find($data['id']);
        $element->title = $data['title'];
        $element->pre_rub = $data['pre_rub'];
        $element->pre_usd = $data['pre_usd'];
        $element->price = $data['price'];
        $element->save();
        $element->categories()->detach();
        $element->categories()->attach($request->categories, ['element_id' => $element->id]);
        $element->boxes()->detach();
        $element->boxes()->attach($request->boxes, ['element_id' => $element->id]);
    }

    public function element_item($id, Request $request)
    {
        return Element::with('boxes', 'categories')->find($id);
    }

    public function element_delete($id)
    {
        $element = Element::find($id);
        $element->delete();
        $element->categories()->detach();
        $element->boxes()->detach();
    }

    public function categories()
    {
        return Category::with('elements')->get();
    }

    public function category_item($id, Request $request)
    {
        return Category::with('elements')->find($id);
    }

    public function category_elements($category, Request $request)
    {
        return Element::with('categories')->whereHas('categories', function ($query) use($category) {
            return $query->where('category_id', '=', $category);
        })->get();
    }

    public function categories_store(Request $request)
    {
        $data = request()->all();
        $category = new Category();
        $category->title = $data['title'];
        $category->save();
    }

    public function category_edit(Request $request)
    {
        $data = request()->all();
        $category = Category::find($data['id']);
        $category->title = $data['title'];
        $category->save();
    }

    public function category_delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        $category->elements()->detach();
    }
}
