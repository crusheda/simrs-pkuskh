<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class antrian extends Model
{
    protected $table = 'queue_poli';
    public $timestamps = true;
    use SoftDeletes;
}
