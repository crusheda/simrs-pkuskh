<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class karyawan extends Model
{
    protected $table = 'karyawan';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
