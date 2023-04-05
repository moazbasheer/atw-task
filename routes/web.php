<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
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


Route::get('/change-language', [LanguageController::class, 'change']);

Route::group(['middleware' => ['localize']], function() {
    Route::get('/login', [UserController::class, 'login'])->name('auth.login');
    Route::post('/login', [UserController::class, 'postLogin'])->name('auth.postLogin');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', [UserController::class, 'renderMainPage'])->name('auth.main');
        Route::resource('employees', EmployeeController::class);
        Route::resource('companies', CompanyController::class);
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});
