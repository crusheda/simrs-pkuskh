<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class logtgsperawat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = [
            ['pernyataan'=>'Penkes Pasien Yang Akan Pulang Setelah OPNAME di Rumah Sakit'],
            ['pernyataan'=>'Mengikuti Kursus Membaca EKG'],
            ['pernyataan'=>'Mengikuti Nursing English Course'],
            ['pernyataan'=>'Mengikuti Pelatihan IHT Komunikasi Ffektif'],
            ['pernyataan'=>'Mengikuti Kursus Perawatan Luka Bakar'],
            ['pernyataan'=>'Mengikuti Kursus Perawatan Colostomy'],
            ['pernyataan'=>'Mengikuti Kursus Perawatan Tracheostomy'],
        ];

        DB::table('logtgsperawat')->insert($db);
    }
}
