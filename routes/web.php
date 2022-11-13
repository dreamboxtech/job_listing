<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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
//All listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//Store listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Edit listing to Update
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete listing to Update
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Register User
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//New User Creation
Route::post('/users', [UserController::class, 'store']);

//Log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Login user
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Auth User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

























