<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSurveilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppi_surveilans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_surveilans')->nullable();
            $table->integer('rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('jns_kelamin')->nullable();
            $table->string('umur')->nullable();
            $table->integer('asal_pasang')->nullable();
            $table->integer('asal_ditemukan')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->longText('diagnosa')->nullable();
            $table->integer('jns_surveilans')->nullable();
            
            // JENIS SURVEILANS
            $table->integer('jns_pemasangan')->nullable();
            $table->longText('tujuan_pemasangan')->nullable();
            $table->integer('lokasi')->nullable();
            $table->date('tgl_pemasangan')->nullable();
            $table->date('tgl_infeksi')->nullable();
            $table->longText('tanda_infeksi')->nullable();
            $table->longText('tanda_infeksi_ido')->nullable();
            $table->string('no_ventilator')->nullable();
            $table->longText('tindakan_operasi')->nullable();
            $table->date('tgl_operasi')->nullable();
            $table->integer('dr_operator')->nullable();
            $table->integer('jns_operasi')->nullable();
            $table->integer('user_add')->nullable();
            $table->integer('user_edit')->nullable();
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
        Schema::dropIfExists('ppi_surveilans');
    }
}
