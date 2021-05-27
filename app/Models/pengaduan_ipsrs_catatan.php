<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class pengaduan_ipsrs_catatan extends Model
{
    protected $table = 'pengaduan_ipsrs_catatan';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
