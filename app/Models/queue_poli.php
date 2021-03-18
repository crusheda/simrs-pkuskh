<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class queue_poli extends Model
{
    protected $table = 'queue_poli';
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
