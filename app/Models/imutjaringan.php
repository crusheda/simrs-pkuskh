<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class imutjaringan extends Model
{
    protected $table = 'imutjaringan';
    public $timestamps = false;
    use SoftDeletes;
}
