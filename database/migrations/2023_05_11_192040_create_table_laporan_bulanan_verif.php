<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLaporanBulananVerif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_bulanan_verif', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('queue');
            $table->integer('lap_id');
            $table->integer('role_id');
            $table->string('role_name');
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
        Schema::dropIfExists('laporan_bulanan_verif');
    }
}
