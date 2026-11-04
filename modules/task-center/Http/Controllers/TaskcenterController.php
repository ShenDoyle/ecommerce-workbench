<?php

namespace Workspace${STUDLY}\Http\Controllers;

use App\Http\Controllers\Controller;

class TaskcenterController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['module' => 'task-center', 'status' => 'active']);
    }
}
