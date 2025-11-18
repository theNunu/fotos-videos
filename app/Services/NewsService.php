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
        return $this->newsRepository->store($data);
    }
}
