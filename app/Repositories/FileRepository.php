<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
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
