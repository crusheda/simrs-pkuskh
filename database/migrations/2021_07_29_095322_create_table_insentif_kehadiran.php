<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInsentifKehadiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insentif_kehadiran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_finger')->nullable();
            $table->string('nama')->nullable();
            $table->string('unit')->nullable();
            $table->integer('absen1')->nullable();
            $table->integer('absen2')->nullable();
            $table->integer('absen3')->nullable();
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
        Schema::dropIfExists('insentif_kehadiran');
    }
}
