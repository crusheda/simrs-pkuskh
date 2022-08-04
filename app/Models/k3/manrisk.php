<?php

namespace App\Models\k3;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class manrisk extends Model
{
    protected $table = 'manrisk';
    public $timestamps = true;
    use SoftDeletes;
}
