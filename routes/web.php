<?php

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

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginPage'])->name('login');
Route::post('/login/form', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.form');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');

    // Логист
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_LOGIST]), 'prefix' => 'logist/', 'as' => 'logist.'], function () {
        Route::get('/', [\App\Http\Controllers\Logist\LogistController::class, 'index'])->name('index');
    });

    // Логист
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_STORE_KEEPER]), 'prefix' => 'store-keeper/', 'as' => 'store-keeper.'], function () {
        Route::get('/', [\App\Http\Controllers\Storekeeper\StoreKeeperController::class, 'index'])->name('index');
    });

    // Логист
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_PACKER]), 'prefix' => 'packer/',  'as' => 'packer.'], function () {
        Route::get('/', [\App\Http\Controllers\Packer\PackerController::class, 'index'])->name('index');
    });

    // Логист
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_ADMIN]), 'prefix' => 'admin/',  'as' => 'admin.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    });
});
