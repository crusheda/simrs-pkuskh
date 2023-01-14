<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSysUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_update', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('role');
            $table->longText('deskripsi')->nullable();
            $table->string('title');
            $table->string('filename');
            $table->string('status');
            $table->integer('user');
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
        Schema::dropIfExists('sys_update');
    }
}
