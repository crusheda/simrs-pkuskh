<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class user extends Model
{
    protected $table = 'users';
    public $timestamps = true;
    use Loggable;
    use SoftDeletes;
}
