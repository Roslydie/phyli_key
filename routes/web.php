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

Route::get('/admin/{any?}', function () {
    return view('admin');
})->where('any', '^(?!.*\.(css|js|png|jpg|jpeg|gif|svg|ico|webp|woff2?|ttf|map)$)(?!assets/).*$')->name('admin.page.any');

Route::fallback(function () {
    return view('welcome');
});


