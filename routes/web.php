<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('layouts.home');
});


Route::middleware(['auth'])->group(function(){
    
    // Super Admin
    Route::get('/super-admin/dashboard', function(){
        return view('super-admin.dashboard');
    })->name('super-admin.dashboard');

    // Organisation Admninistrator - see organisation-admin.php for all organisation admin routes
    // Route::get('/organisations/{org_id}/dashboard', function($org_id){
    //     return view('organisation-admin.dashboard');
    // })->name('organisation-admin.dashboard');

    // Manager - see manager.php for all manager routes
    // Route::get('/organisations/{org_id}/manager/dashboard', function($org_id){
    //     return view('manager.dashboard');
    // })->name('manager.dashboard');

    // Carer - see carer.php for all carer routes
    // Route::get('/organisations/{org_id}/carer/dashboard', function($org_id){
    //     return view('carer.dashboard');
    // })->name('carer.dashboard');

    // Client - see client.php for all client routes
    // Route::get('/organisations/{org_id}/client/dashboard', function($org_id){
    //     return view('client.dashboard');
    // })->name('client.dashboard');

    


});