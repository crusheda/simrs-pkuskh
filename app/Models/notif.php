<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class notif extends Model
{
    protected $table = 'notif';
    public $timestamps = true;
    use SoftDeletes;
}
