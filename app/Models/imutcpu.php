<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class imutcpu extends Model
{
    protected $table = 'imutcpu';
    public $timestamps = false;
    use SoftDeletes;
    use Loggable;
}
