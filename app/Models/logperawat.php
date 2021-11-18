<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class logperawat extends Model
{
    protected $table = 'logperawat';
    public $timestamps = true;
    use SoftDeletes;
}
