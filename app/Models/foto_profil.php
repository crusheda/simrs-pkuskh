<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class foto_profil extends Model
{
    protected $table = 'foto_profil';
    public $timestamps = false;
    use SoftDeletes;
}
