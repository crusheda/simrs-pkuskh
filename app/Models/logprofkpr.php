<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class logprofkpr extends Model
{
    protected $table = 'logprofkpr';
    public $timestamps = true;
    use SoftDeletes;
}
