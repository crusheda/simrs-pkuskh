<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class user extends Model
{
    protected $table = 'users';
    public $timestamps = true;
    use Loggable;
}
