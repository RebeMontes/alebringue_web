<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnglishLevelController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\CategoryController;

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
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

// ADMIN
Route::middleware(['auth', 'user_type:admin'])->group(function () {
    //Gestionar usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

//Gestionar lecciones
Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
// Route::resource('lessons', LessonController::class)->middleware('auth');

//Gestionar niveles
Route::get('/levels', [EnglishLevelController::class, 'index'])->name('levels.index');
Route::get('/levels/create', [EnglishLevelController::class, 'create'])->name('levels.create');
Route::post('/levels', [EnglishLevelController::class, 'store'])->name('levels.store');
Route::get('/levels/{level}/edit', [EnglishLevelController::class, 'edit'])->name('levels.edit');
Route::put('/levels/{level}', [EnglishLevelController::class, 'update'])->name('levels.update');
Route::get('/levels/{level}', [EnglishLevelController::class, 'show'])->name('levels.show');
Route::delete('/levels/{level}', [EnglishLevelController::class, 'destroy'])->name('levels.destroy');

Route::get('/words', [WordController::class, 'index'])->name('words.index');
Route::get('/words/create', [WordController::class, 'create'])->name('words.create');
Route::post('/words', [WordController::class, 'store'])->name('words.store');
Route::get('/words/{word}/edit', [WordController::class, 'edit'])->name('words.edit');
Route::put('/words/{word}', [WordController::class, 'update'])->name('words.update');
Route::get('/words/{word}', [WordController::class, 'show'])->name('words.show');
Route::delete('/words/{word}', [WordController::class, 'destroy'])->name('words.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Bulk operations
Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');

});

// USER
Route::middleware(['auth', 'user_type:user'])->group(function () {

});