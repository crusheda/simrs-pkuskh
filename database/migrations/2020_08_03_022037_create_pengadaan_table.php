<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('unit')->nullable();
            $table->text('pemohon')->nullable();
// ->default('text');
                $table->text('barang1')->nullable();
                $table->text('barang2')->nullable();
                $table->text('barang3')->nullable();
                $table->text('barang4')->nullable();
                $table->text('barang5')->nullable();
                $table->text('barang6')->nullable();
                $table->text('barang7')->nullable();
                $table->text('barang8')->nullable();
                $table->text('barang9')->nullable();
                $table->text('barang10')->nullable();
                $table->text('barang11')->nullable();
                $table->text('barang12')->nullable();
                $table->text('barang13')->nullable();
                $table->text('barang14')->nullable();
                $table->text('barang15')->nullable();
                $table->text('barang16')->nullable();
                $table->text('barang17')->nullable();
                $table->text('barang18')->nullable();
                $table->text('barang19')->nullable();
                $table->text('barang20')->nullable();

                $table->string('jumlah1')->nullable();
                $table->string('jumlah2')->nullable();
                $table->string('jumlah3')->nullable();
                $table->string('jumlah4')->nullable();
                $table->string('jumlah5')->nullable();
                $table->string('jumlah6')->nullable();
                $table->string('jumlah7')->nullable();
                $table->string('jumlah8')->nullable();
                $table->string('jumlah9')->nullable();
                $table->string('jumlah10')->nullable();
                $table->string('jumlah11')->nullable();
                $table->string('jumlah12')->nullable();
                $table->string('jumlah13')->nullable();
                $table->string('jumlah14')->nullable();
                $table->string('jumlah15')->nullable();
                $table->string('jumlah16')->nullable();
                $table->string('jumlah17')->nullable();
                $table->string('jumlah18')->nullable();
                $table->string('jumlah19')->nullable();
                $table->string('jumlah20')->nullable();

                $table->string('satuan1')->nullable();
                $table->string('satuan2')->nullable();
                $table->string('satuan3')->nullable();
                $table->string('satuan4')->nullable();
                $table->string('satuan5')->nullable();
                $table->string('satuan6')->nullable();
                $table->string('satuan7')->nullable();
                $table->string('satuan8')->nullable();
                $table->string('satuan9')->nullable();
                $table->string('satuan10')->nullable();
                $table->string('satuan11')->nullable();
                $table->string('satuan12')->nullable();
                $table->string('satuan13')->nullable();
                $table->string('satuan14')->nullable();
                $table->string('satuan15')->nullable();
                $table->string('satuan16')->nullable();
                $table->string('satuan17')->nullable();
                $table->string('satuan18')->nullable();
                $table->string('satuan19')->nullable();
                $table->string('satuan20')->nullable();

                $table->string('harga1')->nullable();
                $table->string('harga2')->nullable();
                $table->string('harga3')->nullable();
                $table->string('harga4')->nullable();
                $table->string('harga5')->nullable();
                $table->string('harga6')->nullable();
                $table->string('harga7')->nullable();
                $table->string('harga8')->nullable();
                $table->string('harga9')->nullable();
                $table->string('harga10')->nullable();
                $table->string('harga11')->nullable();
                $table->string('harga12')->nullable();
                $table->string('harga13')->nullable();
                $table->string('harga14')->nullable();
                $table->string('harga15')->nullable();
                $table->string('harga16')->nullable();
                $table->string('harga17')->nullable();
                $table->string('harga18')->nullable();
                $table->string('harga19')->nullable();
                $table->string('harga20')->nullable();

                $table->string('total1')->nullable();
                $table->string('total2')->nullable();
                $table->string('total3')->nullable();
                $table->string('total4')->nullable();
                $table->string('total5')->nullable();
                $table->string('total6')->nullable();
                $table->string('total7')->nullable();
                $table->string('total8')->nullable();
                $table->string('total9')->nullable();
                $table->string('total10')->nullable();
                $table->string('total11')->nullable();
                $table->string('total12')->nullable();
                $table->string('total13')->nullable();
                $table->string('total14')->nullable();
                $table->string('total15')->nullable();
                $table->string('total16')->nullable();
                $table->string('total17')->nullable();
                $table->string('total18')->nullable();
                $table->string('total19')->nullable();
                $table->string('total20')->nullable();
                $table->string('totalall')->nullable();

                $table->longText('keterangan1')->nullable();
                $table->longText('keterangan2')->nullable();
                $table->longText('keterangan3')->nullable();
                $table->longText('keterangan4')->nullable();
                $table->longText('keterangan5')->nullable();
                $table->longText('keterangan6')->nullable();
                $table->longText('keterangan7')->nullable();
                $table->longText('keterangan8')->nullable();
                $table->longText('keterangan9')->nullable();
                $table->longText('keterangan10')->nullable();
                $table->longText('keterangan11')->nullable();
                $table->longText('keterangan12')->nullable();
                $table->longText('keterangan13')->nullable();
                $table->longText('keterangan14')->nullable();
                $table->longText('keterangan15')->nullable();
                $table->longText('keterangan16')->nullable();
                $table->longText('keterangan17')->nullable();
                $table->longText('keterangan18')->nullable();
                $table->longText('keterangan19')->nullable();
                $table->longText('keterangan20')->nullable();

            $table->text('jnspengadaan')->nullable();
            $table->text('token')->nullable();
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
        Schema::dropIfExists('pengadaan');
    }
}
