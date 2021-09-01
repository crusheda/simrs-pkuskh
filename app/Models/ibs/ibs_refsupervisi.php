<?php

namespace App\Models\ibs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ibs_refsupervisi extends Model
{
    protected $table = 'ibs_refsupervisi';
    public $timestamps = true;
    use SoftDeletes;
}
