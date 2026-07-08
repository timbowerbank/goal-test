<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganisationReporter\DashboardController;


Route::middleware(['auth', 'organisation-reporter.org.access'])
    ->prefix('organisations/{org_id}/organisation-reporter')
    ->name('organisation-reporter.')->group(function(){

        Route::get('inactive', function(){
            return view('organisation-reporter.inactive');
        })->name('inactive');

        Route::get('pending-verification', function () {
            return view('organisation-reporter.pending-verification');
        })->name('pending-verification');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

});