<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDecubitus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppi_decubitus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('umur')->nullable();
            $table->date('tgl_dicatat')->nullable();
            $table->boolean('resiko1')->nullable();
            $table->boolean('resiko2')->nullable();
            $table->boolean('resiko3')->nullable();
            $table->boolean('resiko4')->nullable();
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
        Schema::dropIfExists('ppi_decubitus');
    }
}
