<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LoginController;

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
Route::get('/', function() {
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth-user'])->group(function() {

    // users
    Route::get('users/', [UserController::class, 'index']);
    Route::get('users/create', [UserController::class, 'create'])->middleware('check-create-user-permission');
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{user}', [UserController::class, 'show'])->middleware('check-view-user-permission');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('check-update-user-permission');
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('check-update-user-permission');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('check-delete-user-permission');
    
    // roles
    Route::get('roles/', [RoleController::class, 'index']);
    Route::get('roles/create', [RoleController::class, 'create'])->middleware('check-create-role-permission');
    Route::post('roles', [RoleController::class, 'store']);
    Route::get('roles/{role}', [RoleController::class, 'show'])->middleware('check-view-role-permission');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('check-update-role-permission');
    Route::put('roles/{role}', [RoleController::class, 'update'])->middleware('check-update-role-permission');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('check-delete-role-permission');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
});