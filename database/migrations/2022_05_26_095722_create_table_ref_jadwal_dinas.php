<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRefJadwalDinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_jadwal_dinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->longText('unit');
            $table->string('waktu');
            $table->time('berangkat');
            $table->time('pulang');
            $table->longText('ket')->nullable();
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
        Schema::dropIfExists('ref_jadwal_dinas');
    }
}
