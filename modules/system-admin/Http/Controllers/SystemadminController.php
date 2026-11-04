<?php

namespace Workspace${STUDLY}\Http\Controllers;

use App\Http\Controllers\Controller;

class SystemadminController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['module' => 'system-admin', 'status' => 'active']);
    }
}
