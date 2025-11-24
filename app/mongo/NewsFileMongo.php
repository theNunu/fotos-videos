<?php

use Jenssegers\Mongodb\Eloquent\Model;

class NewsFileMongo extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'news_files';

    protected $fillable = [
        'new_id',
        'file_id',
        'original_name',
        'stored_name',
        'mime_type',
        'size',
        'path',
        'type',        // image | video
    ];

    // ==== CONVERSIÓN AUTOMÁTICA A MAYÚSCULAS (sin tocar BD) =====
    public function getOriginalNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getMimeTypeAttribute($value)
    {
        return strtoupper($value);
    }
}
