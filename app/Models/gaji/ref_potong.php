<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ref_potong extends Model
{
    protected $table = 'ref_gaji_potong';
    public $timestamps = true;
    use SoftDeletes;
}
