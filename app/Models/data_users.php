<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class data_users extends Model
{
    protected $table = 'data_users';
    public $timestamps = false;
    use SoftDeletes;
    // use Loggable;
}
