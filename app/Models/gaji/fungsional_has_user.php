<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fungsional_has_user extends Model
{
    protected $table = 'fungsional_has_user';
    public $timestamps = true;
    use SoftDeletes;
}
