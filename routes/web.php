<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\DashboardController;
Use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});

/** Admin portal routes with authentication **/
Route::group([
    'prefix' => '/admin',
    'middleware' => 'guest'
], function () {
    Route::view('login','auth.login')->name('login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

/** Admin portal routes with authentication**/
Route::group([
    'prefix' => '/admin',
    'middleware' => 'auth'
], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tenant user routes
    Route::get('user-create', [UserController::class, 'index'])->name('user-create');
    Route::get('user-update/{id}', [UserController::class, 'edit'])->name('user-edit');
    Route::delete('user-delete/{id}', [UserController::class, 'destroy'])->name('user-destroy');

    // Tenant register related routes
    Route::post('user-create',[RegisterController::class, 'store']);
    Route::post('user-update/{id}',[UserController::class, 'update'])->name('user-update');
    Route::get('logout', [LoginController::class, 'logout']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
