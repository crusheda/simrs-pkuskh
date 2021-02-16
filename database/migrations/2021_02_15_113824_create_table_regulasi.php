<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRegulasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('sah')->nullable();
            $table->string('judul')->nullable();
            $table->string('jenis')->nullable();
            $table->string('unit')->nullable();
            $table->string('ket')->nullable();
            
                $table->string('title', 200)->nullable();
                $table->string('filename', 200)->nullable();

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
        Schema::dropIfExists('regulasi');
    }
}
