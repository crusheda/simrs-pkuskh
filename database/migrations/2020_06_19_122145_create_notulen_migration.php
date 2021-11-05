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
            $table->string('nama')->nullable();
            $table->integer('kepala')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('lokasi')->nullable();

                $table->string('title1', 200)->nullable();
                $table->longText('title2')->nullable();
                $table->string('title3', 200)->nullable();
                $table->string('title4', 200)->nullable();
                
                $table->string('filename1', 200)->nullable();
                $table->longText('filename2')->nullable();
                $table->string('filename3', 200)->nullable();
                $table->string('filename4', 200)->nullable();

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
