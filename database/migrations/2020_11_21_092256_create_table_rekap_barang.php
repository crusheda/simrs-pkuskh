<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRekapBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapbarang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit')->nullable();
            $table->string('barang')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('jnspengadaan')->nullable();
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
        Schema::dropIfExists('rekapbarang');
    }
}
