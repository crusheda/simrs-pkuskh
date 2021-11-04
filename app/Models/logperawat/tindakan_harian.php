<?php

namespace App\Models\logperawat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tindakan_harian extends Model
{
    protected $table = 'tindakan_harian_perawat';
    public $timestamps = true;
    use SoftDeletes;
}
