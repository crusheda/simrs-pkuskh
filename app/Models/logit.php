<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class logit extends Model
{
    protected $table = 'logit';
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
