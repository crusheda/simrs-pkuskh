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
            $table->string('nama_staf');
            $table->integer('tgl1');
            $table->integer('tgl2');
            $table->integer('tgl3');
            $table->integer('tgl4');
            $table->integer('tgl5');
            $table->integer('tgl6');
            $table->integer('tgl7');
            $table->integer('tgl8');
            $table->integer('tgl9');
            $table->integer('tgl10');
            $table->integer('tgl11');
            $table->integer('tgl12');
            $table->integer('tgl13');
            $table->integer('tgl14');
            $table->integer('tgl15');
            $table->integer('tgl16');
            $table->integer('tgl17');
            $table->integer('tgl18');
            $table->integer('tgl19');
            $table->integer('tgl20');
            $table->integer('tgl21');
            $table->integer('tgl22');
            $table->integer('tgl23');
            $table->integer('tgl24');
            $table->integer('tgl25');
            $table->integer('tgl26');
            $table->integer('tgl27');
            $table->integer('tgl28');
            $table->integer('tgl29')->nullable();
            $table->integer('tgl30')->nullable();
            $table->integer('tgl31')->nullable();
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
