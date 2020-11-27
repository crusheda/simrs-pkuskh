<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tgsperawat extends Model
{
    protected $table = 'tgsperawat';
    public $timestamps = true;
    use SoftDeletes;
}
