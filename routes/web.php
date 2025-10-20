<?php

use App\Http\Controllers\VenueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); 
})->name('home');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 需要登入才能訪問的路由
Route::middleware('auth')->group(function () {
    Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');
    Route::get('/venues/{venue}', [VenueController::class, 'show'])->name('venues.show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/sports/{slug}', [VenueController::class, 'indexByType'])->name('sports.index');
    Route::get('/sports/{slug}/venues/{venue}', [VenueController::class, 'showByType'])->name('sports.show');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');
    Route::delete('/bookings/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/courses/{id}/register', [CourseController::class, 'register'])->name('courses.register');
    Route::get('/courses/{id}/success', [CourseController::class, 'success'])->name('courses.success');
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('my.courses');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
