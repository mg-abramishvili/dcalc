<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Client;
use App\Models\Box;
use App\Models\Element;
use App\Models\Partner;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function user_count()
    {
        return User::count() - 1;
    }

    public function project_count()
    {
        return Project::count();
    }

    public function client_count()
    {
        return Client::count();
    }

    public function partner_count()
    {
        return Partner::count();
    }

    public function element_box_count()
    {
        $boxes = Box::count();
        $elements = Element::count();
        return $boxes + $elements;
    }
}
