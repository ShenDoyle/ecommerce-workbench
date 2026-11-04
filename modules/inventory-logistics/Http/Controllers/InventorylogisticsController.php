<?php

namespace Workspace${STUDLY}\Http\Controllers;

use App\Http\Controllers\Controller;

class InventorylogisticsController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['module' => 'inventory-logistics', 'status' => 'active']);
    }
}
