<?php

use Illuminate\Support\Facades\Route;


// Route untuk menampilkan halaman utama
Route::get('/', function () {
    return view('welcome');
});


