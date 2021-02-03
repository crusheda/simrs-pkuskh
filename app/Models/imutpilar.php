<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class imutpilar extends Model
{
    protected $table = 'imutpilar';
    public $timestamps = false;
    use SoftDeletes;
    use Loggable;
}