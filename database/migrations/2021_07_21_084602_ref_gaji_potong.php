<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefGajiPotong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_gaji_potong', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kriteria')->nullable();
            $table->integer('nominal')->nullable();
            $table->longText('ket')->nullable();
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
        Schema::dropIfExists('ref_gaji_potong');
    }
}
