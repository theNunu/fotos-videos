<?php

use Jenssegers\Mongodb\Eloquent\Model;

class NewsMongo extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'news';

    protected $fillable = [
        'new_id',
        'title',
        'description',
        'file_id',
    ];

    public function files()
    {
        return $this->hasMany(NewsFileMongo::class, 'new_id', 'new_id');
    }

    // ======== FORMATO EXACTO PARA EL GET =========
    protected $appends = ['images', 'videos'];

    public function getImagesAttribute()
    {
        return $this->files()->where('type', 'image')->get();
    }

    public function getVideosAttribute()
    {
        return $this->files()->where('type', 'video')->get();
    }
}
