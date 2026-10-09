<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'ar-simulator')->name('ar.home');
Route::view('/health', 'health')->name('health');