<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{

    public function all()
    {
        return News::get();
    }

    
    public function store(array $data)
    {
        return News::create($data);
    }
}
