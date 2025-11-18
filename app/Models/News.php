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
        // 'original_name',
        // 'stored_name',
        // 'mime_type',
        // 'size',
        // 'path'
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
}
