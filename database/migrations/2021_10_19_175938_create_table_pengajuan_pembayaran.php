<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePengajuanPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_pengajuan_pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pbf')->nullable();
            $table->string('jenis')->nullable();
            $table->string('tgl_pembelian')->nullable();
            $table->string('no_faktur')->nullable();
            $table->string('title')->nullable();
            $table->string('filename')->nullable();
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->string('transaksi')->nullable();
            $table->string('bank')->nullable();
            $table->string('no_rek')->nullable();
            $table->bigInteger('nominal')->nullable();
            $table->bigInteger('diskon_return')->nullable();
            $table->bigInteger('total')->nullable();
            $table->longText('ket')->nullable();
            $table->date('tgl')->nullable();
            $table->dateTime('verif_kabag')->nullable();
            $table->longText('status_kabag')->nullable();
            $table->dateTime('verif_kasubag')->nullable();
            $table->longText('status_kasubag')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_kabag')->nullable();
            $table->integer('id_kasubag')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keu_pengajuan_pembayaran');
    }
}
