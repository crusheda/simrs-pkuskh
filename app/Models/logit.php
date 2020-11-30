<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class logit extends Model
{
    protected $table = 'logit';
    public $timestamps = true;
    use SoftDeletes;
}
