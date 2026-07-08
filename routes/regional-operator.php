<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionalOperator\DashboardController;


Route::middleware(['auth', 'regional-operator.org.access'])
    ->prefix('organisations/{org_id}/regional-operator')
    ->name('regional-operator.')->group(function(){

        Route::get('inactive', function(){
            return view('regional-operator.inactive');
        })->name('inactive');

        Route::get('pending-verification', function () {
            return view('regional-operator.pending-verification');
        })->name('pending-verification');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

});