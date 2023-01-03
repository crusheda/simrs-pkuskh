<?php

namespace App\Http\Controllers\tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\tu\suratmasuk;
use Carbon\Carbon;
use Exception;
use Redirect;
use Storage;
use Auth;

class suratMasukController extends Controller
{
    public function index()
    {
        // $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');

        $data = [
            // 'now' => $now,
        ];

        return view('pages.tu.suratmasuk')->with('list', $data);
    }

    public function store(Request $request)
    {

    }

    // API
    public function apiGet()
    {
        $show = suratmasuk::limit('30')->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }
}
