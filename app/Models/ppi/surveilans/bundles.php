<?php

namespace App\Models\ppi\surveilans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class bundles extends Model
{
    protected $table = 'ppi_surveilans_bundles';
    public $timestamps = true;
    use SoftDeletes;
}
