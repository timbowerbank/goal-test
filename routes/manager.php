<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerDashboardController;

Route::middleware(['auth', 'manager.org.access'])
    ->prefix('organisations/{org_id}/manager')
    ->name('manager.')->group(function(){

        Route::get('inactive', function(){
            return view('manager.inactive');
        })->name('inactive');

        Route::get('pending-verification', function () {
            return view('manager.pending-verification');
        })->name('pending-verification');

        Route::get('dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

});