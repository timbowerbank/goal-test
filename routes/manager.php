<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerDashboardController;

Route::middleware(['auth'])->prefix('organisations/{org_id}/manager')->name('manager.')->group(function(){

    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

    // create more routes here...

});