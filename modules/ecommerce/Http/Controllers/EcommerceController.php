<?php

namespace Workspace\Ecommerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Workspace\Ecommerce\Models\EcBrand;
use Workspace\Ecommerce\Models\EcStore;
use Workspace\Ecommerce\Models\EcProduct;
use Workspace\Ecommerce\Models\EcSku;

class EcommerceController extends Controller
{
    public function dashboard(): JsonResponse
    {
        return response()->json([
            'brands' => EcBrand::count(),
            'stores' => EcStore::count(),
            'products' => EcProduct::count(),
            'skus' => EcSku::count(),
        ]);
    }

    public function brands(): JsonResponse
    {
        return response()->json(['brands' => EcBrand::with('stores')->get()]);
    }

    public function createBrand(Request $request): JsonResponse
    {
        $data = $request->validate(['name' => 'required|string', 'slug' => 'required|string']);
        $brand = EcBrand::create($data);
        return response()->json(['brand' => $brand], 201);
    }
}
