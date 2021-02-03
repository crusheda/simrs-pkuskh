<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class skl extends Model
{
    protected $table = 'skl';
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
