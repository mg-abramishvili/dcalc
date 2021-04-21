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

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Element $element)
    {
        //
    }

    public function edit(Element $element)
    {
        //
    }

    public function update(Request $request, Element $element)
    {
        //
    }

    public function destroy(Element $element)
    {
        //
    }
}
