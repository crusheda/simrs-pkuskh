<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateimutprinterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imutprinter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('namapi')->nullable();
            $table->string('nama')->nullable();
            $table->dateTime('jamawal')->nullable();
            $table->dateTime('jamselesai')->nullable();
            $table->string('keterangan',500)->nullable();
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
        Schema::dropIfExists('imutprinter');
    }
}
