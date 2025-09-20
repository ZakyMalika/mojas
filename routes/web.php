<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/admin', function () {
    return redirect('frontend.admin');
});