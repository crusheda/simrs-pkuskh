<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pbf extends Model
{
    protected $table = 'keu_pbf';
    public $timestamps = true;
    use SoftDeletes;
}
