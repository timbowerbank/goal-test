<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Manager\ManagerViewHomeController;
use App\Http\Controllers\Manager\ManagerViewClientController;

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

        Route::get('homes/{home_id}', [ManagerViewHomeController::class, 'index'])->name('home');

        Route::get('homes/{home_id}/clients/{client_id}', [ManagerViewClientController::class, 'index'])->name('view-client');



});