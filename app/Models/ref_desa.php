<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class ref_desa extends Model
{
    protected $table = 'ref_desa';
    public $timestamps = true;
    use SoftDeletes;
}
