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

/*

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsFile extends Model
{
    protected $table = 'news_files';

    public $timestamps = false;

    protected $fillable = [
        'new_id',
        'file_id',
        'type',
        'url_externo',
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'file_id');
    }
}



*/