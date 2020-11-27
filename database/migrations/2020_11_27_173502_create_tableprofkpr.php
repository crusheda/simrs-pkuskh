<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableprofkpr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profkpr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('queue')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('unit')->nullable();
            $table->string('pernyataan')->nullable();
            $table->string('isian')->nullable();
            $table->dateTime('tgl')->nullable();
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
        Schema::dropIfExists('profkpr');
    }
}
