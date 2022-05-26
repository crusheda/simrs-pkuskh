<?php

namespace App\Models\administrasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detail_jadwal_dinas extends Model
{
    protected $table = 'detail_jadwal_dinas';
    public $timestamps = true;
    use SoftDeletes;
}
