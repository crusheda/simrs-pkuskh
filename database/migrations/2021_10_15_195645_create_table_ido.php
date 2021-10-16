<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableIdo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppi_ido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('umur')->nullable();
            $table->date('tgl_operasi')->nullable();
            $table->date('tgl_ditemukan')->nullable();
            $table->longText('ket')->nullable();
            $table->integer('id_user')->nullable();
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
        Schema::dropIfExists('ppi_ido');
    }
}
