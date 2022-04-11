<?php

namespace App\Models\pengadaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class barang extends Model
{
    protected $table = 'barang';
    public $timestamps = true;
    use SoftDeletes;
}
