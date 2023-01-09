<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class update extends Model
{
    protected $table = 'sys_update';
    public $timestamps = true;
    use SoftDeletes;
}
