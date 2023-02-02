<?php

use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');

    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/sign-up', [AuthController::class, 'signUp'])->name('auth.sign-up');
    Route::get('/sign-up-admin', [AuthController::class, 'signUpAdmin'])->name('auth.sign-up-admin');

    //User Register
    Route::post('/sign-up', [AuthController::class, 'signUpPost'])->name('auth.sign-up.store');
    //Admin Register
    Route::post('/sign-up-admin', [AuthController::class, 'signUpAdminPost'])->name('auth.sign-up-admin.store');

    //Login
    Route::post('/login', [AuthController::class, 'loginPost'])->name('auth.login.post');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::resource('tasks', TaskController::class);
    Route::get('/tasks/{task}/edit-status', [TaskController::class, 'editStatus'])->name('tasks.edit-status');
    Route::put('/tasks/{task}/edit-status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/user/edit-profile', [UserDashboardController::class, 'editProfile'])->name('user.edit-profile');
    Route::get('/user/edit-password', [UserDashboardController::class, 'editPassword'])->name('user.edit-password');

    Route::put('/user/edit-profile', [UserDashboardController::class, 'updateProfile'])->name('user.update-profile');
    Route::put('/user/edit-password', [UserDashboardController::class, 'updatePassword'])->name('user.update-password');
});

Route::middleware(['admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('tasks', TaskController::class)->only(['create', 'store', 'destroy']);
    
});

Route::get('/error', function(){
    return view('error');
})->name('error');


