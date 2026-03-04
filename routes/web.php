<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientDashboardController;



Route::get('/', function () {
    return view('carer.dashboard');
});

Route::get('/dashboard',[ClientDashboardController::class, 'index']);