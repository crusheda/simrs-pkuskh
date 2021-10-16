<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppi_vap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('umur')->nullable();
            $table->date('tgl_dicatat')->nullable();
            $table->longText('diagnosis')->nullable();
            $table->longText('gejala')->nullable();
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
        Schema::dropIfExists('ppi_vap');
    }
}
