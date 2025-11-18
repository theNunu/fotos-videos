<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function any()
    {
        return $this->fileService->any();
    }

    public function index()
    {
        // return $this->fileService->index();
        $files = $this->fileService->index();
    return view('files.index', compact('files'));
    }

    public function upload(Request $request)
    {
        // dd('qwqqw');
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,jpeg,mp4,mov,avi|max:50000'
        ]);

        $fileData = $this->fileService->uploadFile($request->file('file'));

        return response()->json([
            'message' => 'Archivo subido correctamente',
            'data' => $fileData
        ]);
    }

    public function show($id)
    {
        return $this->fileService->getFile($id);
    }
}
