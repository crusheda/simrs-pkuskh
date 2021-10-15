<?php

namespace App\Models\ppi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class isk extends Model
{
    protected $table = 'ppi_isk';
    public $timestamps = true;
    use SoftDeletes;
}
