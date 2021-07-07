<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::all();
    }

    public function user_item($id, Request $request)
    {
        return User::find($id);
    }

    public function users_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        $data = request()->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->elements_prices = $data['elements_prices'];
        $user->elements_edit = $data['elements_edit'];
        $user->save();
    }

    public function user_edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id
        ]);

        $data = request()->all();
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->elements_prices = $data['elements_prices'];
        $user->elements_edit = $data['elements_edit'];
        $user->save();
    }
}
