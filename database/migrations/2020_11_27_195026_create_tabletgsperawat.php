<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabletgsperawat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tgsperawat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('queue')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('unit')->nullable();
            $table->string('pernyataan')->nullable();
            $table->string('ket')->nullable();
            $table->date('tgl')->nullable();
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
        Schema::dropIfExists('tgsperawat');
    }
}
