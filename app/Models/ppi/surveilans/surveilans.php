<?php

namespace App\Models\ppi\surveilans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class surveilans extends Model
{
    protected $table = 'ppi_surveilans';
    public $timestamps = true;
    use SoftDeletes;
}
