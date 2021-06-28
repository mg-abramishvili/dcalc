<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clients()
    {
        return Client::all();
    }

    public function clients_store(Request $request)
    {
        $data = request()->all();
        $client = new Client();
        $client->name = $data['name'];
        $client->type = $data['type'];
        $client->inn = $data['inn'];
        $client->phone = $data['phone'];
        $client->email = $data['email'];
        $client->save();
    }

}
