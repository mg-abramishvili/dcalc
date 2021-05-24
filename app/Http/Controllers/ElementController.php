<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Ecategory;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function elements()
    {
        return Element::with('categories')->get();
    }

    public function elements_count()
    {
        return Element::with('categories')->count();
    }

    public function categories()
    {
        return Ecategory::with('elements')->get();
    }

    public function category_item($id, Request $request)
    {
        return Ecategory::find($id);
    }

    public function category_elements($category, Request $request)
    {
        return Element::with('categories')->whereHas('categories', function ($query) use($category) {
            return $query->where('ecategory_id', '=', $category);
        })->get();
    }

    public function store(Request $request)
    {
        $data = request()->all();
        $element = new Element();
        $element->title = $data['title'];
        $element->price = $data['price'];
        $element->save();
        $element->categories()->attach($request->categories, ['element_id' => $element->id]);
    }

    public function store_ecategory(Request $request)
    {
        $data = request()->all();
        $ecategory = new Ecategory();
        $ecategory->title = $data['title'];
        $ecategory->save();
    }
}
