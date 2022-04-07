<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ref_logit extends Model
{
    protected $table = 'ref_logit';
    public $timestamps = true;
    use SoftDeletes;
}
