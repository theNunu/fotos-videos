<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class File extends Model
{

    protected $primaryKey = 'file_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'file_id',
        'original_name',
        'stored_name',
        'mime_type',
        'size',
        'path'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->file_id) {
                $model->file_id = Str::uuid()->toString();
            }
        });
    }

    public function newsImagenes()
    {
        return $this->belongsToMany(
            News::class,
            'news_files',
            'file_id',
            'new_id'
        );
    }
}
