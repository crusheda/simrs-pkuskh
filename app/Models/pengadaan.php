<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengadaan extends Model
{
    protected $table = 'pengadaan';
    public $timestamps = true;
    use SoftDeletes;
}
