<?php

namespace App\Models\ppi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ido extends Model
{
    protected $table = 'ppi_ido';
    public $timestamps = true;
    use SoftDeletes;
}
