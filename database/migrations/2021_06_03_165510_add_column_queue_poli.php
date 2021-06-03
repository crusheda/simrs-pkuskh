<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQueuePoli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queue_poli', function (Blueprint $table) {
            $table->string('umur', 200)->after('nama')->nullable();
            $table->string('pekerjaan', 200)->after('nama')->nullable();
            $table->string('alamat', 200)->after('nama')->nullable();
            $table->string('ref_desa')->after('nama')->nullable();
            $table->string('no_hp')->after('nama')->nullable();
            $table->string('no_ktp')->after('nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queue_poli');
    }
}
