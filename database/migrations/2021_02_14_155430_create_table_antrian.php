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

                $table->string('queue_paru')->nullable();
                $table->string('queue_mata')->nullable();
                
                $table->string('current_paru')->nullable();
                $table->string('current_mata')->nullable();

            $table->dateTime('tgl')->nullable();
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
