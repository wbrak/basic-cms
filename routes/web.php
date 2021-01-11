<?php

use App\Http\Controllers\ConnectController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

// Content Web
Route::get('/', [ContentController::class, 'getHome'])->name('Home');
Route::get('/about', [ContentController::class, 'getAbout'])->name('About');
Route::get('/contact', [ContentController::class, 'getContact'])->name('Contact');

// Created symlink for production in shared server
Route::get("/storage-link",function(){$targetFolder=storage_path("app/public");$linkFolder=$_SERVER['DOCUMENT_ROOT'].'/storage';symlink($targetFolder,$linkFolder);});

// Router Auth
Route::get('/login', [ConnectController::class, 'getFormLogin'])->name('login');
Route::post('/login', [ConnectController::class, 'postFormLogin'])->name('login');
Route::get('/recover', [ConnectController::class, 'getFormRecover'])->name('recover');
Route::post('/recover', [ConnectController::class, 'postFormRecover'])->name('recover');
Route::get('/reset', [ConnectController::class, 'getFormReset'])->name('reset');
Route::post('/reset', [ConnectController::class, 'postFormReset'])->name('reset');
Route::get('/register', [ConnectController::class, 'getFormRegister'])->name('register');
Route::post('/register', [ConnectController::class, 'postFormRegister'])->name('register');
Route::get('/register/verify/{code}', [ConnectController::class, 'getVerify'])->name('verify');
Route::get('/logout', [ConnectController::class, 'getLogout'])->name('logout');
