<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Manager\ManagerViewHomeController;
use App\Http\Controllers\Manager\ManagerViewClientController;
use App\Http\Controllers\Manager\ManagerViewClientsController;
use App\Http\Controllers\Manager\CarerController;
use App\Http\Controllers\Manager\ManagerViewClientGoalController;
use App\Http\Controllers\Manager\ManagerViewTaskController;


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

        Route::get('homes/{home_id}/clients', [ManagerViewClientsController::class, 'index'])->name('view-clients');

        Route::get('homes/{home_id}/clients/{client_id}', [ManagerViewClientController::class, 'index'])->name('view-client');

        // carers
        Route::get('homes/{home_id}/carers', [CarerController::class, 'index'])->name('view-carers');
        Route::get('homes/{home_id}/carers/{carer_id}', [CarerController::class, 'show'])->name('view-carer');

        // goals
        Route::get('homes/{home_id}/clients/{client_id}/goals/{goal_id}', [ManagerViewClientGoalController::class, 'index'])->name('view-goal');
        Route::get('homes/{home_id}/clients/{client_id}/goals/{goal_id}/tasks/{task_id}', [ManagerViewTaskController::class, 'viewTaskForGoal'])->name('view-task-for-goal');

        // team tasks
        Route::get('homes/{home_id}/carers/{carer_id}/tasks/{task_id}', [ManagerViewTaskController::class, 'viewTaskForCarer'])->name('view-task-for-carer');




});