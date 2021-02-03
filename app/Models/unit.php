<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class unit extends Model
{
    protected $table = 'unit';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
