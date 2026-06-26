<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
})->name('user.page');

Route::get('/admin', function () {
    return view('admin');
})->name('admin.page');



require __DIR__.'/auth.php';
