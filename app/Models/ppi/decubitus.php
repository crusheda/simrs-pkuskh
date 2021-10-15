<?php

namespace App\Models\ppi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class decubitus extends Model
{
    protected $table = 'ppi_decubitus';
    public $timestamps = true;
    use SoftDeletes;
}
