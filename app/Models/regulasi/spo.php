<?php

namespace App\Models\regulasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class spo extends Model
{
    protected $table = 'regulasi_spo';
    public $timestamps = true;
    use SoftDeletes;
}
