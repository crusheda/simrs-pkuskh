<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSurveilansBundles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppi_surveilans_bundles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_surveilans')->nullable();
            $table->integer('jns_surveilans')->nullable();
            $table->integer('opsi')->nullable();
            $table->boolean('jawaban')->nullable();
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
        Schema::dropIfExists('ppi_surveilans_bundles');
    }
}
