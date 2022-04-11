<?php

namespace App\Models\pengadaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengadaan extends Model
{
    protected $table = 'pengadaan';
    public $timestamps = true;
    use SoftDeletes;
}
