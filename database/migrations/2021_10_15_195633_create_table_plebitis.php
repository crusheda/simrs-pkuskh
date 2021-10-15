<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlebitis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppi_plebitis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('umur')->nullable();
            $table->date('tgl_pasang')->nullable();
            $table->string('asal_pasang')->nullable();
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
        Schema::dropIfExists('ppi_plebitis');
    }
}
