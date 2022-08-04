<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableManrisk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manrisk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->longText('unit');
            $table->integer('jenis_resiko');
            $table->integer('proses_utama');
            $table->longText('item_kegiatan');;
            $table->integer('jenis_aktivitas');
            $table->integer('kode_bahaya');
            $table->string('sumber_bahaya');;
            $table->longText('resiko');;
            $table->longText('resedual');;
            $table->integer('dampak');
            $table->integer('frekuensi');
            $table->integer('nilai');
            $table->string('tingkat_resiko');;
            $table->integer('elm');
            $table->integer('sbt');
            $table->integer('eng');
            $table->integer('adm');
            $table->integer('apd');
            $table->longText('deskripsi');
            $table->string('waktu_penerapan');
            $table->integer('inherent');
            $table->integer('residual');
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
        Schema::dropIfExists('manrisk');
    }
}
