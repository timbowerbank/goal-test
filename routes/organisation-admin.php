<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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

    });