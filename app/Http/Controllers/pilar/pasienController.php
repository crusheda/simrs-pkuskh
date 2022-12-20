<?php

namespace App\Http\Controllers\pilar;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Exception;
use App\User;
use Redirect;
use Response;
use Storage;
use Auth;

class pasienController extends Controller
{
    public function index()
    {
        return view('pages.pilar.index');
        // return view('pages.lab.antigen.index')->with('list', $data);
    }

    public function getPasien($rm)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://103.155.246.25:8000/api/all/'.$rm);
        $data = json_decode($res->getBody());

        return response()->json($data, 200);
    }
}
