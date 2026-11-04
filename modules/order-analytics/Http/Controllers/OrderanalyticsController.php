<?php

namespace Workspace${STUDLY}\Http\Controllers;

use App\Http\Controllers\Controller;

class OrderanalyticsController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['module' => 'order-analytics', 'status' => 'active']);
    }
}
