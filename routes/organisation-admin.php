<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GoalController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ManagerController;


Route::middleware(['auth', 'administrator.org.access'])
    ->prefix('organisations/{org_id}/organisation-admin')
    ->name('organisation-admin.')->group(function(){

        Route::get('inactive', function(){
            return view('organisation-admin.inactive');
        })->name('inactive');

        Route::get('pending-verification', function(){
            return view('organisation-admin.pending-verification');
        })->name('pending-verification');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // homes
        Route::get('homes', [HomeController::class, 'index'])->name('view-homes');

        // goals
        Route::get('goals', [GoalController::class, 'index'])->name('view-goals');

        // clients
        Route::get('clients', [ClientController::class, 'index'])->name('view-clients');

        // managers
        Route::get('managers', [ManagerController::class, 'index'])->name('view-managers');

    });