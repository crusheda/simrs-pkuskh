<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class pengaduan_ipsrs extends Model
{
    protected $table = 'pengaduan_ipsrs';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}