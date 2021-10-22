<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class pengajuan_pembayaran extends Model
{
    protected $table = 'keu_pengajuan_pembayaran';
    public $timestamps = true;
    use SoftDeletes;
    use Loggable;
}