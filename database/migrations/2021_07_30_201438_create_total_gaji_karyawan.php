<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalGajiKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji_total', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_terima')->nullable();
            $table->integer('total_potong')->nullable();
            $table->integer('total_kotor')->nullable();
            $table->integer('total_bersih')->nullable();
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
        Schema::dropIfExists('gaji_total');
    }
}
