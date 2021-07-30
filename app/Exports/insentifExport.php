<?php

namespace App\Exports;

use App\Models\insentifKehadiran;
use Maatwebsite\Excel\Concerns\FromCollection;

class insentifExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return insentifKehadiran::all();
    }
}
