<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{

    public function all()
    {
        // return News::get();
        $news = News::with(['images', 'videos'])->get();
        // dd($news->images);
        return $news;
    }


    public function store(array $data)
    {
        return News::create($data);
    }

    public function update(News $news, array $data)
    {
        $news->update($data);
        return $news;
    }

    public function find(string $id)
    {
        return News::with(['file', 'images', 'videos'])->find($id);
    }
}
