<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class imutjaringan extends Model
{
    protected $table = 'imutjaringan';
    public $timestamps = false;
    use SoftDeletes;
    // use Loggable;
}
