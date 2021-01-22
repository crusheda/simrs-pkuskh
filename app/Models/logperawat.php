<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class logperawat extends Model
{
    protected $table = 'logperawat';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
