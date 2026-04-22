<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('organisations/{org_id}/manager')->name('manager.')->group(function(){

    Route::get('/dashboard', function($org_id){
        return view('manager.dashboard');
    })->name('dashboard');

});