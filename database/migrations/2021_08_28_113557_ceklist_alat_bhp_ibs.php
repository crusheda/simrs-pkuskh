<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CeklistAlatBhpIbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibs_supervisi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_supervisi')->nullable();
            $table->integer('id_tim')->nullable();
            $table->boolean('kondisi')->nullable();
            $table->string('ket')->nullable();
            $table->dateTime('tgl')->nullable();
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
        Schema::dropIfExists('ibs_supervisi');
    }
}
