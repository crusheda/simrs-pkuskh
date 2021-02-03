<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class rekapbarang extends Model
{
    protected $table = 'rekapbarang';
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
