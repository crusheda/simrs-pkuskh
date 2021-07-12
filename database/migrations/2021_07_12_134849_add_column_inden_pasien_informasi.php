<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIndenPasienInformasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queue_poli', function (Blueprint $table) {
            $table->integer('id_dokter')->after('queue')->nullable();
            $table->string('cara_bayar', 200)->after('umur')->nullable();
            $table->string('cara_daftar', 200)->after('umur')->nullable();
            $table->longText('catatan')->after('inden')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
