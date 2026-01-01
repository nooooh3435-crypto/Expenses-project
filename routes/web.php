<?php
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\UserController;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\ExpenseController;
// use App\Http\Controllers\ProfileController;



// Route::get('/', function () {
//     return redirect()->route('login.form');
// });
// Route::get('/login', [UserController::class, 'indexLogin'])->name('login.form');
// Route::post('/login', [UserController::class, 'storeLogin']);
// Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Route::get('/register', [RegisterController::class, 'indexRegister'])->name('register.form');
// Route::post('/register', [RegisterController::class, 'storeRegister']);

// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [UserController::class, 'indexDash'])->name('dashboard');
//     Route::post('/expenses', [ExpenseController::class, 'storeExpense'])->name('expenses.store');
//     Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroyExpense'])->name('expenses.destroy');
//     Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
//     Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// });
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login.form'); // البداية من صفحة تسجيل الدخول
});

// Auth
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');
});

// Dashboard & Expenses
Route::middleware('auth')->group(function () {
Route::get('/dashboard', [ExpenseController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/expenses', [ExpenseController::class, 'storeExpense'])->name('expenses.store');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::delete('/expenses/{id}/delete', [ExpenseController::class, 'destroyExpense'])->name('expenses.delete');
});
// Profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');







?>