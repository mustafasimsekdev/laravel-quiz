<?php

use App\Http\Controllers\Admin\DataTableController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\ToDo\ToDoController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Artisan;
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
Auth::routes();

Route::redirect('/', '/login');

// swicth lang
Route::get('lang/{locale}', [LanguageController::class, 'swap']);


Route::group(['prefix' => '/admin','middleware' => 'auth'], function (){
    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/my-profile', [ProfileController::class, 'index'])->name('admin.my-profile.index');
    Route::post('/my-profile/update-general', [ProfileController::class, 'updateGeneral'])->name('admin.my-profile.general.update');
    Route::post('/my-profile/update-password', [ProfileController::class, 'updatePassword'])->name('admin.my-profile.password.update');
    Route::post('/my-profile/remove-image', [ProfileController::class, 'removeImage'])->name('admin.my-profile.image.remove');

    Route::get('/users-list', [UserController::class, 'index'])->name('admin.users.list');
    Route::get('/user-add', [UserController::class, 'add'])->name('admin.user.add');
    Route::post('/user-store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user-edit/user-delete', [UserController::class, 'destroy'])->name('admin.user.delete');
    Route::post('/user-edit/update-general', [UserController::class, 'updateGeneral'])->name('admin.user.general.update');
    Route::post('/user-edit/remove-image', [UserController::class, 'removeImage'])->name('admin.user.image.remove');

    Route::get('/to-do-list', [ToDoController::class, 'index'])->name('admin.todo.list');
    Route::get('/to-do-add', [ToDoController::class, 'add'])->name('admin.todo.add');
    Route::post('/to-do-store', [ToDoController::class, 'store'])->name('admin.todo.store');
    Route::get('/to-do-edit/{id}', [ToDoController::class, 'edit'])->name('admin.todo.edit');
    Route::post('/to-do-edit/delete', [ToDoController::class, 'destroy'])->name('admin.todo.delete');
    Route::post('/to-do-edit/update', [ToDoController::class, 'update'])->name('admin.todo.update');

    Route::get('/datatable', [DataTableController::class, 'load']);
    Route::post('/datatable', [DataTableController::class, 'load']);
});

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return "Cache is cleared";
});
