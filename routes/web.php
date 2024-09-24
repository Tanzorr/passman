<?php

use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
});
