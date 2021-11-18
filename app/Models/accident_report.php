<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class accident_report extends Model
{
    protected $table = 'accident_report';
    public $timestamps = true;
    use SoftDeletes;
}
