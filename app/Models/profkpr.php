<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class profkpr extends Model
{
    protected $table = 'profkpr';
    public $timestamps = true;
    use SoftDeletes;
}
