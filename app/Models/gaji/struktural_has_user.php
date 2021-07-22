<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class struktural_has_user extends Model
{
    protected $table = 'struktural_has_user';
    public $timestamps = true;
    use SoftDeletes;
}
