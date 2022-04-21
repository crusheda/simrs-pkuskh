<?php

namespace App\Models\regulasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class panduan extends Model
{
    protected $table = 'regulasi_panduan';
    public $timestamps = true;
    use SoftDeletes;
}
