<?php

namespace App\Http\Controllers\excell;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use Carbon\Carbon;
use Exception;
use Redirect;
use Auth;

class fingerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = user::whereNotNull('nik')->where('status',null)->get();
        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('roles.name as nama_role','users.*')
                ->where('users.status',null)
                ->get();

        $data = [
            'user' => $user,
            'show' => $show
        ];

        // print_r($data);
        // die();
        return view('pages.it.finger.set-finger')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = user::find($id);
        $data->id_finger = $request->id_finger;
        $data->save();

        return redirect()->back()->with('message','Perubahan Berhasil Dilakukan ID Finger : '.$data->id_finger);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function nullID($id)
    {
        $data = user::find($id);
        $data->id_finger = null;
        $data->save();

        return redirect()->back()->with('message','Penghapusan Berhasil Dilakukan ID User : '.$data->id);
    }
}
