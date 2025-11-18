<?php

namespace App\Services;

use App\FileRelationType;
use App\Repositories\NewsRepository;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function create(array $data)
    {
        // dd($data);
        // return $this->newsRepository->store($data);

        // crear noticia
        $news = $this->newsRepository->store([
            'title' => $data['title'],
            'description' => $data['description'],
            'file_id' => $data['file_id'] ?? null,
        ]);

        // asignar imágenes adicionales (tabla pivote)
        // if (!empty($data['imagenes'])) {
        //     $news->imagenes()->sync($data['imagenes']);
        // }

        // Insertar imágenes (type = image)
        if (!empty($data['images'])) {
            foreach ($data['images'] as $fileId) {
                $news->imagenes()->attach($fileId, [
                    'type' => FileRelationType::IMAGE->value
                ]);
            }
        }

        // Insertar videos (type = video)
        if (!empty($data['videos'])) {
            foreach ($data['videos'] as $fileId) {
                $news->imagenes()->attach($fileId, [
                    'type' => FileRelationType::VIDEO->value
                ]);
            }
        }


        return $news;
    }
}
