<?php

namespace App\Models\pengadaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ref_barang extends Model
{
    protected $table = 'ref_barang';
    public $timestamps = true;
    use SoftDeletes;
}
