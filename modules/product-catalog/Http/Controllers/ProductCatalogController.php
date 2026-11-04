<?php

namespace Workspace\ProductCatalog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Workspace\Ecommerce\Models\EcProduct;
use Workspace\Ecommerce\Models\EcSku;
use Workspace\Ecommerce\Models\EcCodeMapping;

class ProductCatalogController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['products' => EcProduct::with('skus')->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'brand_id' => 'required|integer',
            'name' => 'required|string',
            'internal_code' => 'required|string|unique:ec_products,internal_code',
        ]);
        return response()->json(['product' => EcProduct::create($data)], 201);
    }

    public function skus(): JsonResponse
    {
        return response()->json(['skus' => EcSku::with('product')->get()]);
    }

    public function addCodeMapping(Request $request): JsonResponse
    {
        $data = $request->validate([
            'sku_id' => 'required|integer',
            'code_type' => 'required|in:bj,jd,69',
            'code_value' => 'required|string',
            'quantity' => 'integer|min:1',
        ]);
        return response()->json(['mapping' => EcCodeMapping::create($data)], 201);
    }
}
