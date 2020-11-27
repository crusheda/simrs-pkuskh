<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class logtgsperawat extends Model
{
    protected $table = 'logtgsperawat';
    public $timestamps = true;
    use SoftDeletes;
}
