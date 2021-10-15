<?php

namespace App\Models\ppi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class plebitis extends Model
{
    protected $table = 'ppi_plebitis';
    public $timestamps = true;
    use SoftDeletes;
}
