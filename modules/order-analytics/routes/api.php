<?php

use Illuminate\Support\Facades\Route;

Route::prefix('w/{slug}/api/ecommerce/order-analytics')
    ->middleware(['web', 'auth', App\Base\Workspace\ResolveWorkspace::class, 'workspace.member', 'workspace.breaker'])
    ->group(function (): void {
        Route::get('/', function () { return response()->json(['module' => 'order-analytics']); });
    });
