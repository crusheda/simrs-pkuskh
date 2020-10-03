<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class imutpilar extends Model
{
    protected $table = 'imutpilar';
    public $timestamps = false;
    use SoftDeletes;
}
