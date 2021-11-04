<?php

namespace App\Models\perencanaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class rka extends Model
{
    protected $table = 'rka';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
