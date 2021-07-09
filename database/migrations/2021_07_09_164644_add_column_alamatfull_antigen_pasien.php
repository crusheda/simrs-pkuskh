<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAlamatfullAntigenPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('antigen', function (Blueprint $table) {
            $table->string('desa', 200)->after('alamat')->nullable();
            $table->string('kecamatan', 200)->after('alamat')->nullable();
            $table->string('kabupaten', 200)->after('alamat')->nullable();
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
