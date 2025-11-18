<?php

namespace App\Services;

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
        if (!empty($data['imagenes'])) {
            $news->imagenes()->sync($data['imagenes']);
        }

        return $news;
    }
}
