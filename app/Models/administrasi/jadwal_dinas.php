<?php

namespace App\Models\administrasi;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class jadwal_dinas extends Model
{
    protected $table = 'jadwal_dinas';
    public $timestamps = true;
    use SoftDeletes;
}
