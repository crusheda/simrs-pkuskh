<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetailJadwalDinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jadwal_dinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_jadwal');
            $table->integer('id_staf');
            $table->date('tgl');
            $table->integer('id_ref');
            $table->string('waktu');
            $table->time('berangkat');
            $table->time('pulang');
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
        Schema::dropIfExists('detail_jadwal_dinas');
    }
}
