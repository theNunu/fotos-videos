<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{

    public function all()
    {
        // return News::get();
        return News::with(['files', 'images', 'videos'])->get();
    }

    
    public function store(array $data)
    {
        return News::create($data);
    }

    public function find(string $id)
    {
        return News::with(['file', 'images', 'videos'])->find($id);
    }
}
