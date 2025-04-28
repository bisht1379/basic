<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('admin.auth.login');
// });

// Auth::routes();
// Route::get('user/login', [App\Http\Controllers\AdminAuthController::class, 'readFile'])->name('admin.readFile');

// add comment
Route::get('user/login', [App\Http\Controllers\AdminAuthController::class, 'index'])->name('admin.login');
Route::post('/password/reset', [App\Http\Controllers\AdminAuthController::class, 'sendResetLink'])->name('admin.reset');
Route::get('user/forget-password', [App\Http\Controllers\AdminAuthController::class, 'forgetPassword'])->name('admin.forget.password');
Route::get('user/showChangePasswordForm', [App\Http\Controllers\AdminAuthController::class, 'showChangePasswordForm'])->name('change.password');
Route::post('user/updatePassword', [App\Http\Controllers\AdminAuthController::class, 'updatePassword'])->name('update.password');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('admin/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');
Route::group(['middleware'=>'admin'],function(){
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('file-upload', [App\Http\Controllers\UserDashboardController::class, 'store'])->name('file.upload'); 
 
Route::delete('/file/delete/{id}', [App\Http\Controllers\UserDashboardController::class, 'delete'])->name('file.delete');

Route::prefix('admin')->group(function () {
    Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
    Route::get('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
    Route::get('/role/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
    Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::post('/role/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::post('file-upload', [App\Http\Controllers\UserDashboardController::class, 'store'])->name('file.upload'); 
    Route::delete('/file/delete/{id}', [App\Http\Controllers\UserDashboardController::class, 'delete'])->name('file.delete');
    Route::get('user/reset/password',[App\Http\Controllers\UserController::class,'resetPassword'])->name('user.reset.password');
    Route::post('user/reset/password',[App\Http\Controllers\UserController::class,'postresetPassword'])->name('user.reset.post');
    Route::post('/store-prediction-result', [App\Http\Controllers\UserDashboardController::class, 'storePredictionResult'])->name('store.prediction.result');
});

});


