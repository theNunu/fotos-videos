<?php

namespace App\Services;

use App\Repositories\FileRepository;

class FileService
{
    protected $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function any()
    {
        return "hola desde servicce";
    }

    public function uploadFile($uploadedFile)
    {
        // dd('ppp');
        // Guardar en storage/app/public/files
        $storedPath = $uploadedFile->store('files', 'public');

        return $this->fileRepository->store([
            'original_name' => $uploadedFile->getClientOriginalName(),
            'stored_name'   => basename($storedPath),
            'mime_type'     => $uploadedFile->getMimeType(),
            'size'          => $uploadedFile->getSize(),
            'path'          => $storedPath
        ]);
    }

    public function getFile(string $id)
    {
        return $this->fileRepository->find($id);
    }
}
