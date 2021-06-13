<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableUsersKepeg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nick')->after('name')->nullable();
            $table->string('nik')->after('name')->nullable();
            $table->string('nip')->after('name')->nullable();
            $table->string('jns_kelamin')->after('name')->nullable();
            $table->string('temp_lahir')->after('name')->nullable();
            $table->date('tgl_lahir')->after('name')->nullable();
            $table->string('status_kawin')->after('name')->nullable();
            $table->string('jabatan')->after('name')->nullable();
            $table->date('masuk_kerja')->after('name')->nullable();
            $table->string('ig')->after('remember_token')->nullable();
            $table->string('fb')->after('remember_token')->nullable();
            $table->string('no_hp')->after('remember_token')->nullable();
            $table->longText('alamat_ktp')->after('remember_token')->nullable();
            $table->longText('alamat_dom')->after('remember_token')->nullable();
            $table->string('jln_ktp')->after('remember_token')->nullable();
            $table->string('jln_dom')->after('remember_token')->nullable();

                $table->string('ktp_provinsi')->after('remember_token')->nullable();
                $table->string('ktp_kabupaten')->after('remember_token')->nullable();
                $table->string('ktp_kecamatan')->after('remember_token')->nullable();
                $table->string('ktp_kelurahan')->after('remember_token')->nullable();

                $table->string('dom_provinsi')->after('remember_token')->nullable();
                $table->string('dom_kabupaten')->after('remember_token')->nullable();
                $table->string('dom_kecamatan')->after('remember_token')->nullable();
                $table->string('dom_kelurahan')->after('remember_token')->nullable();

                $table->string('sd')->after('remember_token')->nullable();
                $table->string('smp')->after('remember_token')->nullable();
                $table->string('sma')->after('remember_token')->nullable();
                $table->string('d1')->after('remember_token')->nullable();
                $table->string('d3')->after('remember_token')->nullable();
                $table->string('d4')->after('remember_token')->nullable();
                $table->string('s1')->after('remember_token')->nullable();
                $table->string('s2')->after('remember_token')->nullable();
                $table->string('s3')->after('remember_token')->nullable();

                $table->integer('th_sd')->after('remember_token')->nullable();
                $table->integer('th_smp')->after('remember_token')->nullable();
                $table->integer('th_sma')->after('remember_token')->nullable();
                $table->integer('th_d1')->after('remember_token')->nullable();
                $table->integer('th_d3')->after('remember_token')->nullable();
                $table->integer('th_d4')->after('remember_token')->nullable();
                $table->integer('th_s1')->after('remember_token')->nullable();
                $table->integer('th_s2')->after('remember_token')->nullable();
                $table->integer('th_s3')->after('remember_token')->nullable();

            $table->longText('no_str')->after('remember_token')->nullable();
            $table->date('masa_str')->after('remember_token')->nullable();
            $table->date('masa_sip')->after('remember_token')->nullable();
            $table->longText('pengalaman_kerja')->after('remember_token')->nullable();
            $table->longText('riwayat_penyakit')->after('remember_token')->nullable();
            $table->longText('riwayat_penyakit_keluarga')->after('remember_token')->nullable();
            $table->longText('riwayat_operasi')->after('remember_token')->nullable();
            $table->longText('riwayat_penggunaan_obat')->after('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('users');
    }
}
