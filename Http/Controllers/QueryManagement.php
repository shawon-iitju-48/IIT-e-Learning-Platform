<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\TeacherPost;
use App\Models\UserModel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class QueryManagement extends Controller
{
    public function updateprofile(Request $request)
    {
        $request->validate(
            [
                'email' => 'email',
            ]
        );

        $r = UserModel::find(session('u_id'));
        $s = StudentModel::find(session('u_id'));

        $r->email = $request['email'];
        $r->fname = $request['fname'];
        $r->lname = $request['lname'];

        if ($request['password'] != "") {
            $r->password = Hash::make($request['password']);
        }
        $r->phone = $request['phone'];
        $s->skills = $request['skills'];

        if ($request['bg'] != "Select Your Blood Group") {
            $r->bg = $request['bg'];
        }
        if ($request['gender'] != "") {
            $r->gender = $request['gender'];
        }

        $s->hall = $request['hall'];

        if ($request['semester'] != "Select Your Semester") {
            $s->semester = $request['semester'];
        }

        if (isset($request['dp'])) {
            $r->dp = $request->file('dp')->store('public/dbstorage/images');
        }

        $r->save();
        $s->save();
        $uid = session('u_id');
        $goa = DB::select("select *from user where u_id=$uid;");
        $namep = $goa[0]->fname . ' ' . $goa[0]->lname;
        session()->put('name', $namep);
        session()->put('dp', $goa[0]->dp);

        return redirect('/profile');

    }
    public function updatetprofile(Request $request)
    {
        $request->validate(
            [
                'email' => 'email',
            ]
        );

        $r = UserModel::find(session('u_id'));
        $s = TeacherModel::find(session('u_id'));

        $r->email = $request['email'];
        $r->fname = $request['fname'];
        $r->lname = $request['lname'];

        if ($request['password'] != "") {
            $r->password = Hash::make($request['password']);
        }
        $r->phone = $request['phone'];
        $s->rinterest = $request['rinterest'];

        if ($request['bg'] != "Select Your Blood Group") {
            $r->bg = $request['bg'];
        }
        if ($request['gender'] != "") {
            $r->gender = $request['gender'];
        }

        $s->designition = $request['designition'];

        if (isset($request['dp'])) {
            $r->dp = $request->file('dp')->store('public/dbstorage/images');
        }

        $r->save();
        $s->save();
        $uid=session('u_id');
        $goa=DB::select("select *from user where u_id=$uid;");
            $namep=$goa[0]->fname.' '.$goa[0]->lname;
            session()->put('name', $namep);
            session()->put('dp', $goa[0]->dp);
        return redirect('/profile');

    }
    public function teacherpost(Request $request)
    {

        $request->validate(
            [
                'post_content' => 'required',
            ]
        );

        $cid = session('cid');
        $batch = session('batch');

        date_default_timezone_set('Asia/Dhaka');

        $newpost = new TeacherPost();
        $newpost->post = $request['post_content'];
        $newpost->date = date('Y-m-d');
        $newpost->c_id = $cid;
        $newpost->batch = $batch;
        $newpost->save();
        return redirect('/course-task?c_id=' . $cid . '& batch=' . $batch);

    }
    public function teacherfile(Request $request)
    {
        $uid = session('u_id');

        $cid = session('cid');
        $batch = session('batch');

        if ($request->file('files')) {
            foreach ($request->file('files') as $key => $file) {
                $extension = $file->extension();
                $mid = uniqid();
                $name = $file->getClientOriginalName();

                if ($extension == "pdf" || $extension == "PDF") {

                    $filepath = $file->store('public/study_materials/books');

                    $data = array('m_id' => $mid, "u_id" => $uid, "c_id" => $cid, "batch" => $batch);
                    DB::table('study_material')->insert($data);

                    $data = array('m_id' => $mid, "bookpath" => $filepath, "bookname" => $name);
                    DB::table('books')->insert($data);
                } else if ($extension == "pptx" || $extension == "PPTX" || $extension == "ppt") {

                    $filepath = $file->store('public/study_materials/slides');

                    $data = array('m_id' => $mid, "u_id" => $uid, "c_id" => $cid, "batch" => $batch);
                    DB::table('study_material')->insert($data);

                    $data = array('m_id' => $mid, "slidepath" => $filepath, "slidename" => $name);
                    DB::table('slides')->insert($data);
                } else if ($extension == "mp4" || $extension == "MP4" || $extension == "mkv" || $extension == "MKV") {

                    $filepath = $file->store('public/study_materials/records');

                    $data = array('m_id' => $mid, "u_id" => $uid, "c_id" => $cid, "batch" => $batch);
                    DB::table('study_material')->insert($data);

                    $data = array('m_id' => $mid, "videopath" => $filepath, "videoname" => $name);
                    DB::table('records')->insert($data);
                }
            }
        }

        return redirect('/course-task?c_id=' . $cid . '& batch=' . $batch);

    }

    public function coursesdata(Request $request)
    {
        $request->validate(
            [
                'batch' => 'required',
                'cname' => 'required',
            ]
        );

        date_default_timezone_set('Asia/Dhaka');
        $time = date("F d, Y");
        $cid = $request['cid'];
        $batch = $request['batch'];
        $details = DB::select("select *from course where c_id=$cid and batch=$batch ");
        if (count($details) == 0) {
            $uid = session('u_id');
            $data = array('c_id' => $cid, "u_id" => $uid, "cstatus" => 0, "archivestatus" => 0, "batch" => $batch, "creation" => $time);
            DB::table('course')->insert($data);
        }
        return redirect('/courses');

    }
    public function coursesstudata(Request $request)
    {
        $request->validate(
            [
                'cname1' => 'required',
            ]
        );

        date_default_timezone_set('Asia/Dhaka');
        $time = date("F d, Y");
        $cid = $request['cid1'];
        $uid = session('u_id');
        $res = DB::select('select * from user natural join batch where u_id = ?', [$uid]);
        $batch = $res[0]->batch;

        $details = DB::select("select *from course where c_id=$cid and batch=$batch ");
        $enrolled = DB::select("select *from enroll where c_id=$cid and batch=$batch and u_id=$uid");
        if (count($details) == 1 and count($enrolled) == 0) {

            $data = array('c_id' => $cid, "u_id" => $uid, "batch" => $batch);
            DB::table('enroll')->insert($data);
        }
        return redirect('/courses');

    }
}
