<?php

namespace App\Models\ibs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ibs_has_tim extends Model
{
    protected $table = 'ibs_has_tim';
    public $timestamps = true;
    use SoftDeletes;
}
