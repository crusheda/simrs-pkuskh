<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class pendapatan_kasir extends Model
{
    protected $table = 'keu_pendapatan_kasir';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}
