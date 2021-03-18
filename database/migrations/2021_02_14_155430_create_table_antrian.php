<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAntrian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_poli', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_rm')->nullable();
            $table->string('nama')->nullable();
            $table->string('kode_queue')->nullable();
            $table->string('queue')->nullable();
            $table->boolean('inden')->nullable();

                $table->dateTime('tgl_queue')->nullable();
                $table->dateTime('tgl_estimasi')->nullable();
                $table->dateTime('tgl_pending')->nullable();
                $table->dateTime('tgl_visite')->nullable();

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
        Schema::dropIfExists('queue_poli');
    }
}
