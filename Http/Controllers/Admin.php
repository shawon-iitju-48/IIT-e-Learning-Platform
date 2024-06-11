<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function home()
    {
        $Info = DB::select("select *from batch");
        return view('admin.home')->with(compact('Info'));
    }
    public function searchdata(Request $req)
    {
        $batch = $req['batch'];
        $goa = DB::select("select *from batch where batch=$batch;");
        return response()->json($goa);
    }
    public function updatedata(Request $req)
    {
        $data = array('u_id' => $req['uid'], "batch" => $req['batch']);
        DB::table('batch')->insert($data);
        return redirect('/iitadmin');
    }
    public function excel(Request $req)
    {
        $req['excel'];
        $request->file('excel')->store('public/dbstorage/images');

        return redirect('/iitadmin');
    }
}
