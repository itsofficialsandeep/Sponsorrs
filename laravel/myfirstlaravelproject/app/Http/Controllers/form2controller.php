<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class form2controller extends Controller
{
    public function showform(Request $request)
    {
        return view("form2");
    }

    public function processFormData(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        // this code will upload the file to the server
        echo $request->file('nameofinputfiletype')->storeAs('public/uploads',"filename");

        print_r($request->all());
    }
}