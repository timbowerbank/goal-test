<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Carer\DashboardController;
use App\Http\Controllers\Carer\CarerHomeController;
use App\Http\Controllers\Carer\CarerViewTaskController;
use App\Http\Controllers\Carer\ClientController;
use App\Http\Controllers\Carer\CarerGoalController;

Route::middleware(['auth', 'carer.org.access'])
    ->prefix('organisations/{org_id}/carer')
    ->name('carer.')->group(function(){
        
        Route::get('inactive', function(){
            return view('carer.inactive');
        })->name('inactive');

        Route::get('pending-verification', function(){
            return view('carer.pending-verification');
        })->name('pending-verification');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('homes/{home_id}', [CarerHomeController::class, 'index'])->name('home');

        Route::get('homes/{home_id}/clients', [ClientController::class, 'index'])->name('view-clients');

        Route::get('homes/{home_id}/clients/{client_id}', [ClientController::class, 'show'])->name('view-client');

        Route::get('homes/{home_id}/tasks/', [CarerViewTaskController::class, 'index'])->name('view-tasks');

        Route::get('homes/{home_id}/tasks/{task_id}', [CarerViewTaskController::class, 'show'])->name('view-task');

        Route::get('homes/{home_id}/clients/{client_id}/goals/{goal_id}', [CarerGoalController::class, 'show'])->name('view-goal');

        Route::get('homes/{home_id}/clients/{client_id}/goals/{goal_id}/tasks/{task_id}', [CarerViewTaskController::class, 'showForGoal'])->name('view-goal-task');


    });