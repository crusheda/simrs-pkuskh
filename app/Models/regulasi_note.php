<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class regulasi_note extends Model
{
    protected $table = 'regulasi_note';
    public $timestamps = true;
    use SoftDeletes;
}
