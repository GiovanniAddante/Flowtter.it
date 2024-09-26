<?php

use App\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;

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

Route::get('/', [PublicController::class, 'homepage'])->name('home');
Route::get('/categoria/{category}', [PublicController::class, 'categoryShow'])->name('categoryShow');

// CRUD Advertisement
Route::get('/advertisement/create', [AdvertisementController::class, 'create'])->name('advertisement.create');
Route::get('/advertisement/index', [AdvertisementController::class, 'index'])->name('advertisement.index');
Route::get('/advertisement/show/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisement.show-detail');
Route::get('/advertisement/edit/{advertisement}', [AdvertisementController::class, 'edit'])->name('advertisement.edit');


// rotte revisore
Route::get('/revisor/index',[RevisorController::class,'index'])->name('revisor.index');
Route::patch('/accept/advertisement/{advertisement}',[RevisorController::class,'acceptAdevertisement'])->name('revisor.accept');
Route::patch('/reject/advertisement/{advertisement}',[RevisorController::class,'rejectAdevertisement'])->name('revisor.reject');

// Richiesta revisore
Route::get('/revisor/become-revisor',[RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('revisor.become');
Route::get('/revisor/request{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');
Route::post('/revisor/request', [RevisorController::class, 'requestRevisor'])->name('revisor.request');

// Imposta Lingua
Route::post('/lingua/{lang}',[PublicController::class,'setLanguage'])->name('setLocale');

//Ricerca annuncio
Route::get('/search/advertisement', [PublicController::class, 'searchAdvertisements'])->name('advertisements.search');

// Eliminazione articolo
Route::delete('/advertisement/delete/{advertisement}', [AdvertisementController::class, 'destroy'])->name('advertisement.delete');