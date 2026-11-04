<?php

namespace Workspace\BrandStore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Workspace\Ecommerce\Models\EcBrand;
use Workspace\Ecommerce\Models\EcStore;

class BrandStoreController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'brands' => EcBrand::with('stores')->get(),
            'stores' => EcStore::with('brand')->get(),
        ]);
    }

    public function createBrand(Request $request): JsonResponse
    {
        $data = $request->validate(['name' => 'required|string', 'slug' => 'required|string']);
        return response()->json(['brand' => EcBrand::create($data)], 201);
    }

    public function createStore(Request $request): JsonResponse
    {
        $data = $request->validate([
            'brand_id' => 'required|integer',
            'name' => 'required|string',
            'platform' => 'required|in:jd,tmall,tiktok,amazon',
            'external_id' => 'nullable|string',
        ]);
        return response()->json(['store' => EcStore::create($data)], 201);
    }

    public function toggleStore(int $id): JsonResponse
    {
        $store = EcStore::findOrFail($id);
        $store->update(['is_active' => ! $store->is_active]);
        return response()->json(['store' => $store]);
    }
}
