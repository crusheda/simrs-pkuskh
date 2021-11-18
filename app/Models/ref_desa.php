<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ref_desa extends Model
{
    protected $table = 'ref_desa';
    public $timestamps = true;
    use SoftDeletes;
}
