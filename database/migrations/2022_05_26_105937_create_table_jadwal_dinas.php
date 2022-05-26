<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJadwalDinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_dinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_jadwal');
            $table->integer('id_user');
            $table->integer('id_unit');
            $table->string('nama_user');
            $table->longText('unit');
            $table->date('waktu');
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
        Schema::dropIfExists('jadwal_dinas');
    }
}
