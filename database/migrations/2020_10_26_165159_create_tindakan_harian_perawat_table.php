<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakanHarianPerawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdkperawat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('queue')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('unit')->nullable();
            $table->string('pertanyaan')->nullable();
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
        Schema::dropIfExists('tdkperawat');
    }
}
