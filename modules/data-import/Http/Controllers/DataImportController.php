<?php

namespace Workspace\DataImport\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Workspace\Ecommerce\Models\EcImportJob;

class DataImportController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:51200',
            'import_type' => 'required|in:orders,inventory,products',
        ]);

        $file = $request->file('file');
        $hash = hash_file('sha256', $file->getRealPath());
        $path = $file->store('import-uploads', 'local');

        $job = EcImportJob::create([
            'file_name' => $file->getClientOriginalName(),
            'import_type' => $request->input('import_type'),
            'status' => 'pending',
            'file_hash' => $hash,
        ]);

        return response()->json(['job' => $job, 'path' => $path], 201);
    }

    public function jobs(): JsonResponse
    {
        return response()->json(['jobs' => EcImportJob::orderByDesc('id')->get()]);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(['job' => EcImportJob::findOrFail($id)]);
    }
}
