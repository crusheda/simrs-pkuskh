<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class setRoleUser extends Model
{
    protected $table = 'set_role_users';
    public $timestamps = true;
    use SoftDeletes;
}
