<?php

namespace App\Models\ibs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ibs_supervisi extends Model
{
    protected $table = 'ibs_supervisi';
    public $timestamps = true;
    use SoftDeletes;
}
