<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSuratKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tu_surat_keluar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('urutan')->nullable();
            $table->integer('kode')->nullable();
            $table->string('nomor')->nullable();
            $table->integer('jenis')->nullable();
            $table->longText('isi')->nullable();
            $table->longText('tujuan')->nullable(); // CUSTOM LIST SUGGESTIONS
            $table->date('tgl')->nullable();
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
        Schema::dropIfExists('tu_surat_keluar');
    }
}
