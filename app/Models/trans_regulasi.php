<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class trans_regulasi extends Model
{
    protected $table = 'trans_regulasi';
    public $timestamps = true;
    use SoftDeletes;
}
