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


Route::get('/change-language', [LanguageController::class, 'change']); // route for changing the language of the system (locale).

Route::group(['middleware' => ['localize']], function() { // a middleware handling changing language of system (locale).

    Route::get('/login', [UserController::class, 'login'])->name('auth.login'); // route for rendering login page.
    Route::post('/login', [UserController::class, 'postLogin'])->name('auth.postLogin'); // route for handling login post request.

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', [UserController::class, 'renderMainPage'])->name('auth.main'); // route for rendering the main page.
        Route::resource('employees', EmployeeController::class); // resource for employee routes(CRUD).
        Route::resource('companies', CompanyController::class); // resource for company routes (CRUD).
        Route::post('/logout', [UserController::class, 'logout'])->name('logout'); // route for handling log out request.
    });
});
