<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePendapatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_pendapatan_kasir', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('poli')->nullable();
            $table->string('cara_bayar')->nullable();
            $table->string('bank')->nullable();
            $table->string('shift')->nullable();
            $table->bigInteger('nominal')->nullable();
            $table->date('tgl')->nullable();
            $table->dateTime('verif_kabag')->nullable();
            $table->dateTime('verif_kasubag')->nullable();
            $table->longText('ket')->nullable();
            $table->integer('id_user')->nullable();
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
        Schema::dropIfExists('keu_pendapatan_kasir');
    }
}
