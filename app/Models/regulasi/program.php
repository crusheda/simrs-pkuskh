<?php

namespace App\Models\regulasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class program extends Model
{
    protected $table = 'regulasi_program';
    public $timestamps = true;
    use SoftDeletes;
}
