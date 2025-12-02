<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NewsFile extends Pivot
{
    protected $table = 'news_files';

    protected $fillable = [
        'new_id',
        'file_id',
        'type',
        'url_externo'
    ];

    public $timestamps = false;
}
