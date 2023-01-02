<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSuratMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tu_surat_masuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('urutan')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->date('tgl_diterima')->nullable();
            $table->string('asal')->nullable();
            $table->string('nomor')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('tempat')->nullable();
            $table->dateTime('tglFrom')->nullable();
            $table->dateTime('tglTo')->nullable();
            $table->string('title')->nullable();
            $table->string('filename')->nullable();
            $table->integer('user')->nullable();
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
        Schema::dropIfExists('tu_surat_masuk');
    }
}
