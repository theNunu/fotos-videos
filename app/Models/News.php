<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $primaryKey = 'new_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'file_id',
        'title',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->new_id) {
                $model->new_id = Str::uuid()->toString();
            }
        });
    }

    // 🔹 Relación con un file principal (portada o archivo único)
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id', 'file_id');
    }

    // imágenes adicionales (muchos a muchos) 
    // 🔹 Relación con muchos files a través de la tabla pivote news_files
    public function newsFiles()
    {
        return $this->belongsToMany(
            File::class,
            'news_files',
            'new_id',
            'file_id'
        )->withPivot('type');
    }
    // 🔹 Para filtrar solo imágenes 
    public function images()
    {
        return $this->newsFiles()->wherePivot('type', 'image');
    }

    // 🔹 Para filtrar solo videos
    public function videos()
    {
        return $this->newsFiles()->wherePivot('type', 'video');
    }
}
