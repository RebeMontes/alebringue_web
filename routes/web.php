<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Bulk operations
Route::post('/admin/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');
Route::post('/admin/users/bulk-activate', [UserController::class, 'bulkActivate'])->name('users.bulk-activate');
Route::post('/admin/users/bulk-deactivate', [UserController::class, 'bulkDeactivate'])->name('users.bulk-deactivate');

});

// USER
Route::middleware(['auth', 'user_type:user'])->group(function () {

});