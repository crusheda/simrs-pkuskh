<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class imutprinter extends Model
{
    protected $table = 'imutprinter';
    public $timestamps = false;
    use SoftDeletes;
}
