<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class tgsperawat extends Model
{
    protected $table = 'tgsperawat';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
