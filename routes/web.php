<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function(){
    
    // Super Admin
    Route::get('/super-admin/dashboard', function(){
        return view('super-admin.dashboard');
    })->name('super-admin.dashboard');

    // Organisation Admninistrator
    Route::get('/organisations/{org_id}/dashboard', function($org_id){
        return view('organisation-admin.dashboard');
    })->name('organisation-admin.dashboard');

    // Manager
    Route::get('/organisations/{org_id}/manager/dashboard', function($org_id){
        return view('manager.dashboard');
    })->name('manager.dashboard');

    // Carer
    Route::get('/organisations/{org_id}/carer/dashboard', function($org_id){
        return view('carer.dashboard');
    })->name('carer.dashboard');

    // Client
    Route::get('/organisations/{org_id}/client/dashboard', function($org_id){
        return view('client.dashboard');
    })->name('client.dashboard');

    


});