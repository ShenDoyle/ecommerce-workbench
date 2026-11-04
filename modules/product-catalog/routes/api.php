<?php

use Illuminate\Support\Facades\Route;
use Workspace\ProductCatalog\Http\Controllers\ProductCatalogController;

Route::prefix('w/{slug}/api/ecommerce/product-catalog')
    ->middleware(['web', 'auth', App\Base\Workspace\ResolveWorkspace::class, 'workspace.member', 'workspace.breaker'])
    ->group(function (): void {
        Route::get('/products', [ProductCatalogController::class, 'index']);
        Route::post('/products', [ProductCatalogController::class, 'store']);
        Route::get('/skus', [ProductCatalogController::class, 'skus']);
        Route::post('/code-mappings', [ProductCatalogController::class, 'addCodeMapping']);
    });
