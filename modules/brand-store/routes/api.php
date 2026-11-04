<?php

use Illuminate\Support\Facades\Route;
use Workspace\BrandStore\Http\Controllers\BrandStoreController;

Route::prefix('w/{slug}/api/ecommerce/brand-store')
    ->middleware(['web', 'auth', App\Base\Workspace\ResolveWorkspace::class, 'workspace.member', 'workspace.breaker'])
    ->group(function (): void {
        Route::get('/', [BrandStoreController::class, 'index']);
        Route::post('/brands', [BrandStoreController::class, 'createBrand']);
        Route::post('/stores', [BrandStoreController::class, 'createStore']);
        Route::put('/stores/{id}/toggle', [BrandStoreController::class, 'toggleStore']);
    });
