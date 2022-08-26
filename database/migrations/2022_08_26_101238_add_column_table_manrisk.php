<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableManrisk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manrisk', function (Blueprint $table) {
            $table->dateTime('residualdate10')->nullable()->after('residual');
            $table->dateTime('residualdate9')->nullable()->after('residual');
            $table->dateTime('residualdate8')->nullable()->after('residual');
            $table->dateTime('residualdate7')->nullable()->after('residual');
            $table->dateTime('residualdate6')->nullable()->after('residual');
            $table->dateTime('residualdate5')->nullable()->after('residual');
            $table->dateTime('residualdate4')->nullable()->after('residual');
            $table->dateTime('residualdate3')->nullable()->after('residual');
            $table->dateTime('residualdate2')->nullable()->after('residual');
            $table->dateTime('residualdate1')->nullable()->after('residual');
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
