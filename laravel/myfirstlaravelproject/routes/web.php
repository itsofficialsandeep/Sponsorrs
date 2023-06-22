<?php

use App\Http\Controllers\form2controller;
use App\Http\Controllers\myfirstcontroller;
use App\Http\Controllers\myfirstinvokablecontroller;
use Illuminate\Support\Facades\Route;
use App\Models\Customer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo', function () {
    echo 'Welcome to the demo application';
});

Route::get('/hello/{val?}', function ($val = null) {
    $data = compact('val');
    return view("hello")->with($data);
});

Route::any('/layout', function () {
    return view('layouts.main');
});


Route::get('/signup', [myfirstcontroller::class, 'controllerFunction'])->middleware("routedWebGuard");
Route::post('/profile', [myfirstcontroller::class, 'profile']);
Route::get('invoke', myfirstinvokablecontroller::class);

Route::get('/signup2', [form2controller::class, 'showform']);
Route::post('/processForm', [form2controller::class, 'processFormData']);

Route::get('/model', function () {
    $customer = Customer::all();

    echo "<pre>";
    print_r($customer->toArray());
    echo "<pre></pre>";
});


// suppose you have many routes here and all routes have common path '/home' 
Route::group(
    ['prefix' => '/home'],
    function () {
        // you can create a new route here
    
    }
);