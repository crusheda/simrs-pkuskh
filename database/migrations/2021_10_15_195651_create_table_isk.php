<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableIsk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppi_isk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('umur')->nullable();
            $table->string('gejala')->nullable();
            $table->longText('alasan')->nullable();
            $table->longText('hasil')->nullable();
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
        Schema::dropIfExists('ppi_isk');
    }
}
