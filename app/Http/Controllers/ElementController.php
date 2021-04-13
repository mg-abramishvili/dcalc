<?php

namespace App\Http\Controllers;

use App\Models\Element;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function index()
    {
        return Element::all();
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
