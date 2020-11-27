<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class logprofkpr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = [
            ['pernyataan'=>'Pelatihan Hypnotherapy'],
            ['pernyataan'=>'Pelatihan BTCLS'],
            ['pernyataan'=>'Seminar Keperawatan'],
            ['pernyataan'=>'Pelatihan Wound Care'],
            ['pernyataan'=>'Pelatihan Hypnokhitan'],
            ['pernyataan'=>'Mengikuti IHT Rumah Sakit'],
            ['pernyataan'=>'Mengikuti Pelatihan Bedah / Kamar Operasi'],
            ['pernyataan'=>'Mengikuti Pelatihan Hemodialisa'],
            ['pernyataan'=>'Mengikuti Pelatihan ICU/ICCU'],
            ['pernyataan'=>'Mengikuti Pelatihan Perawat Anestesi'],
            ['pernyataan'=>'Mengikuti pelatihan BHD Internal Rumah Sakit'],
        ];

        DB::table('logprofkpr')->insert($db);
    }
}
