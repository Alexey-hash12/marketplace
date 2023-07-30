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
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    // Логист
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_LOGIST, \App\Models\User::ROLE_ADMIN]), 'prefix' => 'logist/', 'as' => 'logist.'], function () {
        Route::get('/supply-calculations/{warehouse?}', [\App\Http\Controllers\Logist\LogistController::class, 'supplyCalculation'])->name('supply-calculations');
        Route::get('/{warehouse?}', [\App\Http\Controllers\Logist\LogistController::class, 'index'])->name('index');
    });

    // Кладовщик
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_STORE_KEEPER, \App\Models\User::ROLE_ADMIN]), 'prefix' => 'store-keeper/', 'as' => 'store-keeper.'], function () {
        Route::get('/leftovers/{warehouse?}', [\App\Http\Controllers\Storekeeper\StoreKeeperController::class, 'leftovers'])->name('leftovers');
        Route::post('/leftovers/add', [\App\Http\Controllers\Storekeeper\StoreKeeperController::class, 'addLeftOver'])->name('leftovers.add');
        Route::get('/{type?}', [\App\Http\Controllers\Storekeeper\StoreKeeperController::class, 'index'])->name('index');
    });

    // Упаковщик
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_PACKER, \App\Models\User::ROLE_ADMIN]), 'prefix' => 'packer/',  'as' => 'packer.'], function () {
        Route::get('/', [\App\Http\Controllers\Packer\PackerController::class, 'index'])->name('index');
    });

    // Админ
    Route::group(['middleware' => 'user.role:' . implode(',', [\App\Models\User::ROLE_ADMIN]), 'prefix' => 'admin/',  'as' => 'admin.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');

        // Продукты
        Route::group(['prefix' => 'products/', 'as' => 'products.'], function() {
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'products'])->name('index');
            Route::post('/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeProducts'])->name('storeProducts');
            Route::post('/delete', [\App\Http\Controllers\Admin\AdminController::class, 'deleteProducts'])->name('deleteProducts');
            Route::post('/close/', [\App\Http\Controllers\Admin\AdminController::class, 'closeProduct'])->name('close');
            Route::post('/warehouses/store', [\App\Http\Controllers\Admin\AdminController::class, 'warehouseStore'])->name('warehouses.store');
        });

        // Поставки
        Route::group(['prefix' => 'incomes/', 'as' => 'incomes.'], function() {
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'incomes'])->name('index');
            Route::post('/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeIncomes'])->name('storeUsers');
            Route::post('/update/{income}', [\App\Http\Controllers\Admin\AdminController::class, 'updateIncomes'])->name('updateUsers');
            Route::post('/delete/{income}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteIncomes'])->name('deleteUsers');
        });

        Route::group(['prefix' => 'marketplace/', 'as' => 'marketplace.'], function () {
           Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'marketplaces'])->name('index');
           Route::post('/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeMarketplace'])->name('store');
           Route::post('/update', [\App\Http\Controllers\Admin\AdminController::class, 'updateMarketplace'])->name('update');
            Route::post('/delete', [\App\Http\Controllers\Admin\AdminController::class, 'deleteMarketplace'])->name('delete');
        });

        // Пользователи
        Route::group(['prefix' => 'users/', 'as' => 'users.'], function() {
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'users'])->name('index');
            Route::post('/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeUsers'])->name('storeUsers');
            Route::post('/delete/', [\App\Http\Controllers\Admin\AdminController::class, 'deleteUsers'])->name('deleteUsers');
        });

        // Токены
        Route::group(['prefix' => 'tokens/', 'as' => 'tokens.'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'token'])->name('index');
            Route::post('/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeToken'])->name('storeToken');
            Route::post('/delete', [\App\Http\Controllers\Admin\AdminController::class, 'deleteToken'])->name('deleteToken');
        });

        // Остатки
        Route::group(['prefix' => 'leftovers/', 'as' => 'left-overs.'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'leftover'])->name('index');
            Route::post('/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeLeftOver'])->name('storeLeftOver');
            Route::post('/update/', [\App\Http\Controllers\Admin\AdminController::class, 'updateLeftOver'])->name('updateLeftOver');
        });

        // Склады
        Route::group(['prefix' => 'warehouses/', 'as' => 'warehouses.'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'warehouses'])->name('index');
            Route::post('/store', [\App\Http\Controllers\Admin\AdminController::class, 'storeWarehouse'])->name('storeWarehouse');
            Route::post('/delete', [\App\Http\Controllers\Admin\AdminController::class, 'deleteWarehouse'])->name('deleteWarehouse');
            Route::post('/update', [\App\Http\Controllers\Admin\AdminController::class, 'updateWarehouse'])->name('updateWarehouse');
        });
    });
});
