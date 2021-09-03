<?php

namespace App\Http\Controllers\android;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIcontroller extends Controller
{
    //Function untuk Login
    function loginAndroid(Request $request) {
        $logins = DB::table('login')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->get();
        
        if (count($logins) > 0) {
            foreach ($logins as $logg) {
                $result["success"] = "1";
                $result["message"] = "success";
                //untuk memanggil data sesi Login
                $result["id"] = $logg->id;
                $result["nama"] = $logg->nama;
                $result["nim"] = $logg->nim;
                $result["email"] = $logg->email;
            }
            echo json_encode($result);
        } else {
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }
}
