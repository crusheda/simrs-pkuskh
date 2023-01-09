<?php

namespace App\Models\regulasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class kebijakan extends Model
{
    use SearchableTrait;
    
    // protected $searchable = [
    //     'columns' => [
    //         'judul' => 100,
    //     ]
    // ];

    protected $table = 'regulasi_kebijakan';
    public $timestamps = true;
    use SoftDeletes;
}
