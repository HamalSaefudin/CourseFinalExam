<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PagesController::class, 'dashboard'])->name('index')->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.action');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->name('register.action');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/instructor', InstructorController::class)->except('show');
    Route::resource('/qualification', QualificationController::class)->except('show');
});

Route::middleware(['auth', 'role:user,admin'])->group(function () {
    Route::resource('/course', CourseController::class)->except('show');
    Route::resource('/transactions', TransactionsController::class)->except('show');
});
