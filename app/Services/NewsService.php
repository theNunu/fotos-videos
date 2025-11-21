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

    public function index()
    {
        return $this->newsRepository->all();
    }

    public function create(array $data)
    {
        // Crear noticia
        $news = $this->newsRepository->store([
            'title' => $data['title'],
            'description' => $data['description'],
            'file_id' => $data['file_id'] ?? null,
        ]);

        // Insertar imágenes (type = image)
        if (!empty($data['images'])) {
            foreach ($data['images'] as $fileId) {
                $news->newsFiles()->attach($fileId, [
                    'type' => FileRelationType::IMAGE->value
                ]);
            }
        }

        // Insertar videos (type = video)
        if (!empty($data['videos'])) {
            foreach ($data['videos'] as $fileId) {
                $news->newsFiles()->attach($fileId, [
                    'type' => FileRelationType::VIDEO->value
                ]);
            }
        }

        // 🔥 Recargar la noticia con las relaciones
        $news->load(['files', 'images', 'videos']);

        return $news;
    }

    public function show(string $id)
    {
        return $this->newsRepository->find($id);
    }
}
