<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
    public function store(array $data)
    {
        return News::create($data);
    }
}
