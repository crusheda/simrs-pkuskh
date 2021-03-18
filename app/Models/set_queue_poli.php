<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class set_queue_poli extends Model
{
    protected $table = 'set_queue_poli';
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
