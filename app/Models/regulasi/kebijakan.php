<?php

namespace App\Models\regulasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kebijakan extends Model
{
    protected $table = 'regulasi_kebijakan';
    public $timestamps = true;
    use SoftDeletes;
}
