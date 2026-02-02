<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

Route::get('/', [SearchController::class , 'index']);

Route::post('/Rechercher_Offer' , [SearchController::class , 'search']);
