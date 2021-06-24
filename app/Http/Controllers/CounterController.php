<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function user_count()
    {
        return User::count() - 1;
    }
}
