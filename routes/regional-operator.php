<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionalOperator\DashboardController;
use App\Http\Controllers\RegionalOperator\RegionController;
use App\Http\Controllers\RegionalOperator\HomeController;
use App\Http\Controllers\RegionalOperator\ManagerController;




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

        // region
        Route::get('regions/{region_id}', [RegionController::class, 'show'])->name('view-region');

        // homes in region
        Route::get('regions/{region_id}/homes', [HomeController::class, 'index'])->name('view-homes');
        Route::get('regions/{region_id}/homes/{home_id}', [HomeController::class, 'show'])->name('view-home');

        // managers in region
        Route::get('regions/{region_id}/managers', [ManagerController::class, 'index'])->name('view-managers');

});