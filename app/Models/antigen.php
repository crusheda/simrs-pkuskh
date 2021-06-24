<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class antigen extends Model
{
    protected $table = 'antigen';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
