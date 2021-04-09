<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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

Auth::routes();

Route::group([
        'middleware' => ['assign.guard:web'],
    ],
    function () {
        Route::get('/home', [HomeController::class , 'index'])->name('home');
        Route::resource('posts', PostController::class);
});


Route::prefix('/admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function() {
    Route::namespace('Auth')->group(function(){
        
        //Login Routes
        Route::get('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
        Route::post('/logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');
    
        //Forgot Password Routes
        Route::get('/password/reset', [\App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [\App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    
        //Reset Password Routes
        Route::get('/password/reset/{token}', [\App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [\App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    });

    Route::middleware(['assign.guard:admin'])->group(function () {
        /**
         * Admins routes
         */
        Route::get('/admins', [\App\Http\Controllers\Admin\ManageAdminController::class, 'index'])->name('admins.index');
        Route::get('/admins/create', [\App\Http\Controllers\Admin\ManageAdminController::class, 'create'])->name('admins.create');
        Route::post('/admins', [\App\Http\Controllers\Admin\ManageAdminController::class, 'store'])->name('admins.store');
        Route::get('/admins/{admin}', [\App\Http\Controllers\Admin\ManageAdminController::class, 'show'])->name('admins.show');
        Route::get('/admins/{admin}/edit', [\App\Http\Controllers\Admin\ManageAdminController::class, 'edit'])->name('admins.edit');
        Route::put('/admins/{admin}', [\App\Http\Controllers\Admin\ManageAdminController::class, 'update'])->name('admins.update');
        Route::delete('/admins/{admin}', [\App\Http\Controllers\Admin\ManageAdminController::class, 'destroy'])->name('admins.destroy');

        Route::resource('roles', RoleController::class);

        Route::resource('permissions', PermissionController::class);

        Route::get('storage/profile/photo/{photo}', FileController::class . '@getProfileImage')->name('admins.photo_profile');
        Route::post('storage/profile/photo', FileController::class . '@storeImage')->name('admins.photo_profile.store');
    });
});