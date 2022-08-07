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
            $table->integer('jenis_risiko');
            $table->integer('proses_utama');
            $table->longText('item_kegiatan');
            $table->integer('jenis_aktivitas');
            $table->integer('kode_bahaya');
            $table->string('sumber_bahaya')->nullable();
            $table->longText('risiko')->nullable();
            $table->longText('pengendalian')->nullable();
            $table->integer('dampak');
            $table->integer('frekuensi');
            $table->integer('nilai');
            $table->string('tingkat_risiko');
            $table->integer('elm')->nullable();
            $table->integer('sbt')->nullable();
            $table->integer('eng')->nullable();
            $table->integer('adm')->nullable();
            $table->integer('apd')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('waktu_penerapan')->nullable();
            $table->integer('residual')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
