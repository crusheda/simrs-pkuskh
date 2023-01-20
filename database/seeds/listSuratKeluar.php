<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class listSuratKeluar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datax = [
            ["kode"=>"KEP",  "nama"=>"Surat Keputusan"],
            ["kode"=>"PR",  "nama"=>"Surat Peraturan"],
            ["kode"=>"EDR", "nama"=>"Surat Edaran "],
            ["kode"=>"PER", "nama"=>"Surat Pernyataan"],
            ["kode"=>"KSA", "nama"=>"Surat Kuasa"],
            ["kode"=>"TGS", "nama"=>"Surat Tugas"],
            ["kode"=>"KET", "nama"=>"Surat Keterangan"],
            ["kode"=>"REK", "nama"=>"Surat Rekomendasi"],
            ["kode"=>"UND", "nama"=>"Surat Undangan"],
            ["kode"=>"PRJ", "nama"=>"Surat Perjanjian"],
            ["kode"=>"SPO", "nama"=>"Standar Prosedur Operasional"],
            ["kode"=>"LAI", "nama"=>"Surat Lain Lain"],
            ["kode"=>"PMH", "nama"=>"Surat Permohonan"],
            ["kode"=>"PMB", "nama"=>"Surat Pemberitahuan (External)"],
            ["kode"=>"SERT","nama"=>"Sertifikat"],
            ["kode"=>"PNG", "nama"=>"Surat Penugasan"],
            ["kode"=>"SP",  "nama"=>"Surat Peringatan"],
            ["kode"=>"PGT", "nama"=>"Surat Pengantar"],
            ["kode"=>"BA ", "nama"=>"Berita Acara"],
            ["kode"=>"SPM", "nama"=>"Surat Perintah Membayar"],
            ["kode"=>"PO",  "nama"=>"Surat Pemesanan"]
        ]; 
        DB::table('tu_kd_surat_keluar')->insert($datax);
    }
}
