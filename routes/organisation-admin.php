<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth'])
    ->prefix('organisations/{org_id}/admin')
    ->name('admin.')->group(function(){

        Route::get('inactive', function(){
            return view('organisation-admin.inactive');
        })->name('inactive');

        Route::get('pending-verification', function(){
            return view('organisation-admin.pending-verification');
        });

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    });