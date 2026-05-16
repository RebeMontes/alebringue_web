<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\HomeController;

// Públicas
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protegidas
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

// ADMIN
Route::middleware(['auth', 'user_type:admin'])->group(function () {

});

// USER
Route::middleware(['auth', 'user_type:user'])->group(function () {

});