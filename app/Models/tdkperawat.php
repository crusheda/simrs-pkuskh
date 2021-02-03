<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class tdkperawat extends Model
{
    protected $table = 'tdkperawat';
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
