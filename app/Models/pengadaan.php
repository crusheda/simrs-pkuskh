<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class pengadaan extends Model
{
    protected $table = 'pengadaan';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
