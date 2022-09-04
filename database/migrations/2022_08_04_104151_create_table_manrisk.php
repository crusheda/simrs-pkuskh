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
            $table->dateTime('residualdate1')->nullable();
            $table->dateTime('residualdate2')->nullable();
            $table->dateTime('residualdate3')->nullable();
            $table->dateTime('residualdate4')->nullable();
            $table->dateTime('residualdate5')->nullable();
            $table->dateTime('residualdate6')->nullable();
            $table->dateTime('residualdate7')->nullable();
            $table->dateTime('residualdate8')->nullable();
            $table->dateTime('residualdate9')->nullable();
            $table->dateTime('residualdate10')->nullable();
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
