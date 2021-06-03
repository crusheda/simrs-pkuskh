<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRefDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_desa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabkota')->nullable();
            $table->string('nama_kabkota')->nullable();
            $table->string('provinsi')->nullable();
            $table->integer('kode_pos')->nullable();
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
        Schema::dropIfExists('ref_desa');
    }
}
