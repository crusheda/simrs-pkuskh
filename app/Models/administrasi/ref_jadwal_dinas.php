<?php

namespace App\Models\administrasi;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class ref_jadwal_dinas extends Model
{
    protected $table = 'ref_jadwal_dinas';
    public $timestamps = true;
    use SoftDeletes;
}
