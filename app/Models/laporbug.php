<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class laporbug extends Model
{
    protected $table = 'laporbug';
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
