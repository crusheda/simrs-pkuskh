<?php

namespace App\Models\pengadaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detail_pengadaan extends Model
{
    protected $table = 'detail_pengadaan';
    public $timestamps = true;
    use SoftDeletes;
}
