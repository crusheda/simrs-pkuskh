<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dokter extends Model
{
    protected $table = 'dokter';
    public $timestamps = true;
    use SoftDeletes;
}
