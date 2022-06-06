<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('billing', ['sessionLink' => null]);
})->name('register');

Route::post('/register', [\App\Http\Controllers\Controller::class, 'getLink']);

Route::get('/payments/card/form', [\App\Http\Controllers\Controller::class, 'form'])->name('form');

Route::post('/payments/card/form', [\App\Http\Controllers\Controller::class, 'check'])->name('check');
