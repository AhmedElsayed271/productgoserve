<?php

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SizeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\AuthenticationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
// date_default_timezone_set(Setting::first()->time_zone);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::group(['prefix' => 'dashboard', 'as'=>'dashboard.'], function(){
            Route::get('/login', [AuthenticationController::class, 'loginView'])->name('adminlogin')->middleware('guest:user');
            Route::post('/login', [AuthenticationController::class, 'login'])->middleware('guest:user');

            Route::post('/summernote_upload_image', [Controller::class, 'summernote_upload_image'])->name('summernote_upload_image');
        
            Route::group(['middleware' => 'auth:user'], function () {
                Route::get('/', [HomeController::class, 'index'])->name('home');
                Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
        
                Route::group(['prefix' => 'users', 'as'=>'users.'],function(){
                    Route::get('/', [UserController::class, 'index'])->name('index');
                    Route::get('/create', [UserController::class, 'create'])->name('create');
                    Route::post('/create', [UserController::class, 'store'])->name('store');
                    Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
                    Route::post('{id}/edit', [UserController::class, 'update'])->name('update');
                    Route::get('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
                    Route::get('{id}/activity-logs', [UserController::class, 'activity_logs'])->name('activityLogs');
                });
            
                Route::group(['prefix' => 'roles', 'as'=>'roles.'],function(){
                    Route::get('/', [RoleController::class, 'index'])->name('index');
                    Route::get('/create', [RoleController::class, 'create'])->name('create');
                    Route::post('/create', [RoleController::class, 'store'])->name('store');
                    Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
                    Route::post('{id}/edit', [RoleController::class, 'update'])->name('update');
                    Route::get('{id}/destroy', [RoleController::class, 'destroy'])->name('destroy');
                });

                Route::group(['prefix' => 'categories', 'as'=>'categories.'],function(){
                    Route::get('/', [CategoryController::class, 'index'])->name('index');
                    Route::get('/create', [CategoryController::class, 'create'])->name('create');
                    Route::post('/create', [CategoryController::class, 'store'])->name('store');
                    Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                    Route::post('{id}/edit', [CategoryController::class, 'update'])->name('update');
                    Route::get('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
                });

                Route::group(['prefix' => 'products', 'as'=>'products.'],function(){
                    Route::get('/', [ProductController::class, 'index'])->name('index');
                    Route::get('/create', [ProductController::class, 'create'])->name('create');
                    Route::post('/create', [ProductController::class, 'store'])->name('store');
                    Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
                    Route::post('{id}/edit', [ProductController::class, 'update'])->name('update');
                    Route::get('/destroy/{destory}', [ProductController::class, 'destroy'])->name('destroy');
                    Route::post('/destroy-all', [ProductController::class, 'destroyAll'])->name('destroy.all');
                    Route::get('/import-products', [ProductController::class, 'importProductPage'])->name('import.products.page');
                    Route::post('/import-products', [ProductController::class, 'importProduct'])->name('import.products');
                });
                Route::group(['prefix' => 'sizes', 'as'=>'sizes.'],function(){
                    Route::get('/', [SizeController::class, 'index'])->name('index');
                    Route::get('/create', [SizeController::class, 'create'])->name('create');
                    Route::post('/create', [SizeController::class, 'store'])->name('store');
                    Route::get('{id}/edit', [SizeController::class, 'edit'])->name('edit');
                    Route::post('{id}/edit', [SizeController::class, 'update'])->name('update');
                    Route::get('{id}/destroy', [SizeController::class, 'destroy'])->name('destroy');
                });

                Route::group(['prefix' => 'settings', 'as'=>'settings.'],function(){
                    Route::get('/edit', [SettingController::class, 'edit'])->name('edit');
                    Route::post('/edit', [SettingController::class, 'update'])->name('update');
                });

                Route::group(['prefix' => 'profile', 'as'=>'profile.'],function(){
                    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
                    Route::post('/', [ProfileController::class, 'update'])->name('update');
                });

                Route::post('/update_image', [ProfileController::class, 'update_image'])->name('upload.image');
            });
        });

        Route::get('/test-pop-up', [HomeController::class, 'testPopUp'])->name('testPopUp');
});