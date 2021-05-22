<?php


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\EditAccountController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BinController;

use Illuminate\Support\Facades\Route;


///////////////////////////
//////  VIEW ROUTES  //////
/////////////////////////// 
Route::view('/', 'index');

Route::view('/about', 'about')->name('about');

Route::view('/profile', 'profile')->middleware('auth')->name('profile');



///////////////////////////
///// AUTHENTICATION  /////
///////////////////////////
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/editAccount', [EditAccountController::class, 'index'])->name('editAccount');
Route::post('/editAccount', [EditAccountController::class, 'store']);
Route::delete('/editAccount', [EditAccountController::class, 'destroy']);

Route::get('/changePassword', [ChangePasswordController::class, 'index'])->name('changePassword');
Route::post('/changePassword', [ChangePasswordController::class, 'store']);

Route::get('/forgotPassword', [ForgotPasswordController::class, 'index'])->name('forgotPassword');
Route::post('/forgotPassword', [ForgotPasswordController::class, 'store']);

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');;



///////////////////////////
////////// BINS  //////////
///////////////////////////
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/tomorrow', [HomeController::class, 'tomorrow'])->name('tomorrow');
Route::get('/week', [HomeController::class, 'week'])->name('week');

Route::get('/bins', [BinController::class, 'index'])->name('addBin');
Route::post('/bins', [BinController::class, 'store']);

Route::get('/bins/edit/{bin}', [BinController::class, 'edit'])->name('editBin');
Route::put('/bins/edit/{bin}', [BinController::class, 'update']);
Route::delete('/bins/delete/{bin}', [BinController::class, 'destroy'])->name('deleteBin');
