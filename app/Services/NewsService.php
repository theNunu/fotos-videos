<?php

namespace App\Services;

use App\FileRelationType;
use App\Models\File;
use App\Repositories\NewsRepository;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    // public function create(array $data)
    // {
    //     // dd($data);
    //     // return $this->newsRepository->store($data);

    //     // crear noticia
    //     $news = $this->newsRepository->store([
    //         'title' => $data['title'],
    //         'description' => $data['description'],
    //         'file_id' => $data['file_id'] ?? null,
    //     ]);

    //     // asignar imágenes adicionales (tabla pivote)
    //     // if (!empty($data['imagenes'])) {
    //     //     $news->imagenes()->sync($data['imagenes']);
    //     // }

    //     // Insertar imágenes (type = image)

        
    //     if (!empty($data['images'])) {
    //         foreach ($data['images'] as $fileId) {
    //             $news->imagenes()->attach($fileId, [
    //                 'type' => FileRelationType::IMAGE->value
    //             ]);
    //         }
    //     }

    //     // Insertar videos (type = video)
    //     if (!empty($data['videos'])) {
    //         foreach ($data['videos'] as $fileId) {
    //             $news->imagenes()->attach($fileId, [
    //                 'type' => FileRelationType::VIDEO->value
    //             ]);
    //         }
    //     }


    //     return $news;
    // }

    public function create(array $data)
{
    // Crear noticia base
    $news = $this->newsRepository->store([
        'title' => $data['title'],
        'description' => $data['description'],
        'file_id' => $data['file_id'] ?? null,
    ]);

    // Unir UUIDs de images y videos para revisar duplicados
    $allFiles = array_merge(
        $data['images'] ?? [],
        $data['videos'] ?? []
    );

    // Validar si vienen IDs repetidos en cualquiera de los arrays
    if (count($allFiles) !== count(array_unique($allFiles))) {
        throw new \Exception("Hay UUIDs repetidos entre imágenes y videos.");
    }

    /**
     * PROCESAR IMÁGENES
     */
    if (!empty($data['images'])) {
        foreach ($data['images'] as $fileId) {

            $file = File::find($fileId);

            if (!$file) {
                throw new \Exception("El archivo con ID {$fileId} no existe.");
            }

            // Validar que realmente sea imagen
            if ($file->file_type !== FileRelationType::IMAGE->value) {
                throw new \Exception("El archivo {$fileId} NO es una imagen, pero lo enviaste en 'images'");
            }

            // Insertar en pivote
            $news->imagenes()->attach($fileId, [
                'type' => FileRelationType::IMAGE->value
            ]);
        }
    }

    /**
     * PROCESAR VIDEOS
     */
    if (!empty($data['videos'])) {
        foreach ($data['videos'] as $fileId) {

            $file = File::find($fileId);

            if (!$file) {
                throw new \Exception("El archivo con ID {$fileId} no existe.");
            }

            // Validar que realmente sea video
            if ($file->file_type !== FileRelationType::VIDEO->value) {
                throw new \Exception("El archivo {$fileId} NO es un video, pero lo enviaste en 'videos'");
            }

            // Insertar en pivote
            $news->imagenes()->attach($fileId, [
                'type' => FileRelationType::VIDEO->value
            ]);
        }
    }

    return $news;
}

}
