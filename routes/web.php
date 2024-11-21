<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', [Controller::class, 'getCityName'])->name('getCityName');
