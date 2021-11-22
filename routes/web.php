<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\LocaleController;

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
Route::get('/login', [UserController::class, 'loginview'])->name('loginview');
Route::get('/signup', [UserController::class, 'signupview'])->name('signupview');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');

Route::post('/userlogin', [UserController::class, 'login'])->name('login');

Route::middleware('userauth','locale')->group(function () {
    Route::get('/updateAccount', [UserController::class, 'updateAccountview'])->name('updateAccountview');
    Route::post('/updateAccount', [UserController::class, 'updateAccount'])->name('updateAccount');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/', [NoteController::class, 'index'])->name('index');
    Route::post('addnote',[NoteController::class,'add'])->name('addnote');
    Route::get('/editNote/{id}', [NoteController::class, 'editNoteview'])->name('editNoteview');
    Route::post('/editNote', [NoteController::class, 'editNote'])->name('editNote');
    Route::get('/deleteNote/{id}', [NoteController::class, 'deleteNote'])->name('deleteNote');

    Route::get('/changeLanguage/{language}', [LocaleController::class, 'changeLanguage'])->name('changeLanguage');

});

