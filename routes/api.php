<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialController;

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
