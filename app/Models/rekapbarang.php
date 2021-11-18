<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rekapbarang extends Model
{
    protected $table = 'rekapbarang';
    public $timestamps = true;
    use SoftDeletes;
}
