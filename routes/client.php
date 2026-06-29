<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ClientGoalController;
use App\Http\Controllers\Client\TaskController;

Route::middleware(['auth', 'client.org.access'])
    ->prefix('organisations/{org_id}/client')
    ->name('client.')->group(function(){

        Route::get('pending-verification', function(){
            return view('client.pending-verification');
        });

        Route::get('inactive', function(){
            return view('client.inactive');
        })->name('inactive');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('goals/{goal_id}', [ClientGoalController::class, 'show'])->name('view-goal');

        Route::get('goals/{goal_id}/tasks/{task_id}', [TaskController::class, 'show'])->name('view-task');

    });