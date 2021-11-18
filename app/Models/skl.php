<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class skl extends Model
{
    protected $table = 'skl';
    public $timestamps = true;
    use SoftDeletes;
}
