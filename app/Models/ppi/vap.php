<?php

namespace App\Models\ppi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vap extends Model
{
    protected $table = 'ppi_vap';
    public $timestamps = true;
    use SoftDeletes;
}
