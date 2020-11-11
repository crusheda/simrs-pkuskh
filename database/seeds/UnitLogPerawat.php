<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitLogPerawat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            ['name'=>'IBS'],
            ['name'=>'ICU'],
            ['name'=>'Kebidanan'],
            ['name'=>'Poliklinik'],
            ['name'=>'Bangsal Anak'],
            ['name'=>'Bangsal Dewasa']
        ];

        DB::table('unit')->insert($input);
    }
}
