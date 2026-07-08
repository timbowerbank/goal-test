<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            Route::middleware('web')
                ->group(base_path('routes/manager.php'));
            Route::middleware('web')
                ->group(base_path('routes/carer.php'));
            Route::middleware('web')
                ->group(base_path('routes/client.php'));
            Route::middleware('web')
                ->group(base_path('routes/organisation-admin.php'));
            Route::middleware('web')
                ->group(base_path('routes/family-friend.php'));
            Route::middleware('web')
                ->group(base_path('routes/regional-operator.php'));
            Route::middleware('web')
                ->group(base_path('routes/organisation-reporter.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // check for managers allowed access
        $middleware->alias([
            'manager.org.access' => \App\Http\Middleware\EnsureManagerBelongsToOrganisation::class,
            'carer.org.access' => \App\Http\Middleware\EnsureCarerBelongsToOrganisation::class,
            'client.org.access' => \App\Http\Middleware\EnsureClientBelongsToOrganisation::class,
            'administrator.org.access' => \App\Http\Middleware\EnsureAdministratorBelongsToOrganisation::class,
            'family-friend.access' =>\App\Http\Middleware\EnsureFamilyFriendHasClient::class,
            'regional-operator.org.access' => \App\Http\Middleware\EnsureRegionalOperatorBelongsToOrganisation::class,
            'organisation-reporter.org.access' => \App\Http\Middleware\EnsureOrganisationReporterBelongsToOrganisation::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
