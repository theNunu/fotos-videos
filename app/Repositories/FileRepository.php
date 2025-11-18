<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{
    public function all()
    {
        return File::all();
    }

     public function store(array $data)
    {
        return File::create($data);
    }

    public function find(string $id)
    {
        return File::findOrFail($id);
    }
}
