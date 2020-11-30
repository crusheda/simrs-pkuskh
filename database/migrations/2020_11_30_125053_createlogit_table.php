<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatelogitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('kegiatan');
            $table->string('keterangan');
            $table->string('lokasi');

                $table->string('title', 200)->nullable();
                $table->string('filename', 200)->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('logit');
    }
}
