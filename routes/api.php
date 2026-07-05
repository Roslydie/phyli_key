<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileApiController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Testimonial Routes
Route::prefix('testimonials')->group(function () {
    Route::get('/', [TestimonialController::class, 'index']); // Get all testimonials
    Route::post('/', [TestimonialController::class, 'store']); // Create testimonial
    Route::get('/{testimonial}', [TestimonialController::class, 'show']); // Get single testimonial
    Route::put('/{testimonial}', [TestimonialController::class, 'update']); // Update testimonial
    Route::delete('/{testimonial}', [TestimonialController::class, 'destroy']); // Delete testimonial
    Route::put('/{testimonial}/publish', [TestimonialController::class, 'publish']); // Toggle publish
    Route::get('/published/list', [TestimonialController::class, 'published']); // Get published testimonials
});

Route::apiResource('users', UsersController::class);
Route::post('/addcontact', [ContactController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/contacts/{contact}', [ContactController::class, 'show']);
    Route::put('/contacts/{contact}', [ContactController::class, 'update']);
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy']);
    Route::get('/dashboard-stats', [DashboardController::class, 'getStats']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/profile', [ProfileApiController::class, 'show']);
    Route::put('/profile', [ProfileApiController::class, 'update']);
});
