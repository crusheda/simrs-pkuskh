<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotulenMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('kepala')->nullable();
            $table->dateTime('tanggal');
            $table->string('lokasi');

                $table->string('title1', 200);
                $table->string('title2', 200);
                $table->string('title3', 200);
                $table->string('title4', 200);
                
                $table->string('filename1', 200);
                $table->string('filename2', 200);
                $table->string('filename3', 200);
                $table->string('filename4', 200);

            $table->string('keterangan',500)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('notulen_migration');
    }
}
