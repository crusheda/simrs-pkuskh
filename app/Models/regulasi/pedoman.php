<?php

namespace App\Models\regulasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pedoman extends Model
{
    protected $table = 'regulasi_pedoman';
    public $timestamps = true;
    use SoftDeletes;
}
