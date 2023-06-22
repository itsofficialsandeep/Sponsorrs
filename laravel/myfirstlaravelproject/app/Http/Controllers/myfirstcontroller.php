<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class myfirstcontroller extends Controller
{
    public function controllerFunction(Request $request)
    {
        return view('form');
        //echo "there was a form here";
    }

    public function profile(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // get the submitted data from the form
        print_r($request->all());

        // get the specific data from the form
        print_r($request->input("password"));
    }

}