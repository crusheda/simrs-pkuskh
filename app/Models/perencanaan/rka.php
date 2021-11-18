<?php

namespace App\Models\perencanaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rka extends Model
{
    protected $table = 'rka';
    public $timestamps = true;
    use SoftDeletes;
}
