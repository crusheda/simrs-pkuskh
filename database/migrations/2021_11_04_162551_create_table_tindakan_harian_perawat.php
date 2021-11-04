<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTindakanHarianPerawat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan_harian_perawat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user')->nullable();
            $table->integer('queue')->nullable();
            $table->string('shift')->nullable();
            $table->string('nama')->nullable();
            $table->string('unit')->nullable();
            $table->integer('pernyataan')->nullable();
            $table->string('jawaban')->nullable();
            $table->dateTime('tgl')->nullable();
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
        Schema::dropIfExists('tindakan_harian_perawat');
    }
}
