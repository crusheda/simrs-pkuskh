<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class imutprinter extends Model
{
    protected $table = 'imutprinter';
    public $timestamps = false;
    use SoftDeletes;
    use Loggable;
}
