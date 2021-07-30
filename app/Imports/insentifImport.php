<?php

namespace App\Imports;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\insentifKehadiran;
use Maatwebsite\Excel\Concerns\ToModel;

class insentifImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new insentifKehadiran([
            'id_finger'     => $row[0],
            'nama'    => $row[1],
            'unit'    => $row[2],
            'absen1'    => $row[3],
            'absen2'    => $row[4],
            'absen3'    => $row[5],
        ]);
    }
}
