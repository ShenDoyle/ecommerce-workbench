<?php

use Illuminate\Support\Facades\Route;

Route::prefix('w/{slug}/api/ecommerce/task-center')
    ->middleware(['web', 'auth', App\Base\Workspace\ResolveWorkspace::class, 'workspace.member', 'workspace.breaker'])
    ->group(function (): void {
        Route::get('/', function () { return response()->json(['module' => 'task-center']); });
    });
