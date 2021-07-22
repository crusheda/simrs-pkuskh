<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GajiTerima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji_terima', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user')->nullable();

                // Total Nominal Tunj Struktural
                $table->integer('struktural')->nullable();
                
                // Total Nominal Tunj Fungsional
                $table->integer('fungsional')->nullable();

            $table->integer('gapok')->nullable();
            $table->integer('insentif')->nullable();
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
        Schema::dropIfExists('gaji_terima');
    }
}
