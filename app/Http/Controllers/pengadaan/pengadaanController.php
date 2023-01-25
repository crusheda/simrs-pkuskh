<?php

namespace App\Http\Controllers\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan\ref_barang;
use App\Models\pengadaan\barang;
use App\Models\pengadaan\pengadaan;
use App\Models\pengadaan\detail_pengadaan;
use Carbon\Carbon;
use Auth;

class pengadaanController extends Controller
{
    public function index()
    {
        $show = pengadaan::get();
        $ref = ref_barang::get();

        $data = [
            'show' => $show,
            'ref' => $ref,
        ];

        return view('pages.pengadaan.index')->with('list', $data);
    }
}
