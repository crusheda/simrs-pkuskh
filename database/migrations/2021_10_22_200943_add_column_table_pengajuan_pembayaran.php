<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTablePengajuanPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keu_pengajuan_pembayaran', function (Blueprint $table) {
            $table->longText('ket_lainlain_kabag')->after('ket')->nullable();
            $table->longText('ket_lainlain_kasubag')->after('ket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
