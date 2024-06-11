<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class Management extends Controller
{
    public function home()
    {

        $uid = session('u_id');

        $result = DB::select('select * from user where u_id = ?', [$uid]);
        session()->put('idtype', $result[0]->id_type);

        if ($result[0]->id_type == "Teacher") {
            date_default_timezone_set('Asia/Dhaka');
            $edate = '"' . date("Y-m-d") . '"';
            $etime = '"' . date("H:i:s") . '"';

            $DashInfo[0] = DB::select("select count(c_id)as totalcourse from course where u_id=$uid;");
            $DashInfo[1] = DB::select("select count(c_id)as inprogress from course where u_id=$uid and cstatus!=100;");
            $DashInfo[2] = DB::select("select count(e_id) as ongoingexam from course natural join user natural join exam where u_id=$uid and edate>=$edate");
            $DashInfo[3] = DB::select("select *from course  natural join admincourse natural join semester where u_id=$uid");
            $DashInfo[4] = DB::select("select *from course natural join user natural join exam where u_id=$uid and edate>=$edate");
            $DashInfo[5] = DB::select("select *from user where u_id=$uid;");
            $goa = DB::select("select *from user where u_id=$uid;");
            $namep = $goa[0]->fname . ' ' . $goa[0]->lname;
            session()->put('name', $namep);
            session()->put('dp', $goa[0]->dp);

            return view('teacher_dashboard')->with(compact('DashInfo'));
        } else {
            date_default_timezone_set('Asia/Dhaka');
            $edate = '"' . date("Y-m-d") . '"';
            $res = DB::select('select * from user natural join batch where u_id = ?', [$uid]);
            $batch = $res[0]->batch;
            $DashInfo[0] = DB::select("select count(c_id) as inprogress from course natural join (select c_id from enroll where u_id=$uid)temp where cstatus!=100;");
            $DashInfo[1] = DB::select("select count(c_id) as completed from course natural join (select c_id from enroll where u_id=$uid)temp where cstatus=100;");
            $DashInfo[2] = DB::select("select *from course  natural join (select c_id from enroll where u_id=$uid)temp natural join user natural join admincourse natural join semester where batch=$batch;");
            $DashInfo[3] = DB::select("select *from course inner join (select *from enroll  natural join admincourse natural join semester where u_id=$uid)x on course.c_id=x.c_id and course.batch=x.batch");
            $DashInfo[4] = DB::select("select *from enroll natural join user natural join exam where u_id=$uid and edate>=$edate");
            $DashInfo[5] = DB::select("select *from user where u_id=$uid;");
            $DashInfo[6] = DB::select("SELECT count(*) as totalgiven from takes_part INNER JOIN exam on exam.e_id = takes_part.e_id WHERE u_id=$uid");
            $DashInfo[7] = DB::select("SELECT count(*) as totalexam from enroll NATURAL JOIN exam WHERE u_id=$uid");
            return view('student_dashboard')->with(compact('DashInfo'));
        }

    }
    public function coursecard(Request $request)
    {
        $uid = session('u_id');
        $offset = $request['offset'];
        $res = DB::select('select * from user natural join batch where u_id = ?', [$uid]);
        $batch = $res[0]->batch;

        $Dash = DB::select("select *from course  natural join (select c_id from enroll where u_id=$uid)temp natural join user natural join admincourse natural join semester where batch=$batch limit $offset, 1");
        return response()->json($Dash);
    }
    public function calander(Request $request)
    {
        $uid = session('u_id');
        date_default_timezone_set('Asia/Dhaka');
        $edate = '"' . date("Y-m-d") . '"';
        $Dash = DB::select("select sdate as startDate, edate as endDate , e_title as summary from course natural join user natural join exam where u_id=$uid and edate>=$edate");
        return response()->json($Dash);
    }
    public function calanderstu(Request $request)
    {
        $uid = session('u_id');
        date_default_timezone_set('Asia/Dhaka');
        $edate = '"' . date("Y-m-d") . '"';
        $Dash = DB::select("select sdate as startDate, edate as endDate , e_title as summary from enroll natural join user natural join exam where u_id=$uid and edate>=$edate");
        return response()->json($Dash);
    }
    public function coursecardt(Request $request)
    {
        $uid = session('u_id');
        $offset = $request['offset'];
        $Dash = DB::select("select *from course  natural join admincourse natural join semester where u_id=$uid limit $offset, 1");
        return response()->json($Dash);
    }

    public function profile()
    {
        $uid = session('u_id');

        $result = DB::select('select * from user where u_id = ?', [$uid]);

        if ($result[0]->id_type == "Teacher") {
            $Profileinfo = DB::select("SELECT * FROM user  NATURAL JOIN teacher  where u_id=$uid");
            return view('teacher_profile')->with(compact('Profileinfo'));
        } else {
            $Profileinfo = DB::select("SELECT * FROM user  NATURAL JOIN student  where u_id=$uid");
            return view('student_profile')->with(compact('Profileinfo'));
        }
    }
    public function discussion(Request $request)
    {
        $cid = $request['c_id'];
        $batch = $request['batch'];

        session()->put('cid', $cid);
        session()->put('batch', $batch);
        $Discussion[0] = DB::select("select *from (select *from posts where c_id=$cid and batch=$batch)y inner join (select *from user natural join course where c_id=$cid and batch =$batch)x on x.c_id=y.c_id and x.batch=y.batch order by p_id desc;");
        $Discussion[1] = DB::select("select *from admincourse natural join course where c_id=$cid and batch=$batch");
        return view('discussion')->with(compact('Discussion'));

    }
    public function exams()
    {
        $cid = session('cid');
        $batch = session('batch');

        if ($cid == "") {
            return redirect('/courses');
        }

        $Exams = DB::select("select *from takes_part right join (select *from exam where c_id=$cid and batch=$batch)x  on takes_part.e_id=x.e_id;");
        return view('exam')->with(compact('Exams'));

    }
    public function examsup(Request $request)
    {
        $request->validate(
            [
                'etime' => 'required',
                'edate' => 'required',
                'title' => 'required',
                'grade' => 'required',

            ]
        );

        $cid = session('cid');
        $batch = session('batch');

        date_default_timezone_set('Asia/Dhaka');
        $sdate = date('Y-m-d');
        if ($request->hasFile('file')) {
            $filepath = $request->file('file')->store('public/exam_materials');
            $data = array('etime' => date('H:i:s', strtotime($request['etime'])), 'edate' => $request['edate'], 'e_details' => $request['edetails'], 'grade' => $request['grade'], 'e_title' => $request['title'], 'c_id' => $cid, 'batch' => $batch, 'sdate' => $sdate, 'file' => $filepath);
            DB::table('exam')->insert($data);
        } else {
            $data = array('etime' => date('H:i:s', strtotime($request['etime'])), 'edate' => $request['edate'], 'e_details' => $request['edetails'], 'grade' => $request['grade'], 'e_title' => $request['title'], 'c_id' => $cid, 'batch' => $batch, 'sdate' => $sdate);
            DB::table('exam')->insert($data);
        }

        return redirect('/course-task/exams');

    }
    public function examscards(Request $request)
    {
        $cid = session('cid');
        $batch = session('batch');
        $eid = $request['e_id'];

        $Card[0] = DB::select("select * from takes_part natural join user where e_id=$eid ");
        $Card[1] = DB::select("select *from user natural join (SELECT DISTINCT u_id FROM enroll WHERE u_id not in (select u_id from takes_part natural join user where e_id=$eid) and c_id=$cid and batch=$batch)x");
        $Card[2] = DB::select("select *from exam where e_id=$eid ");
        return view('examcard')->with(compact('Card'));

    }
    public function examsstu(Request $request)
    {
        $cid = session('cid');
        $batch = session('batch');
        $uid = session('u_id');

        $eid = $request['e_id'];
        session()->put('e_id', $eid);

        $Card[0] = DB::select("select *from exam where e_id=$eid");
        $Card[1] = DB::select("select * from takes_part where e_id='$eid' and u_id='$uid'");

        return view('studentexam')->with(compact('Card'));

    }
    public function examsstudata(Request $request)
    {
        $request->validate(
            [
                'file' => 'required',
            ]
        );

        $cid = session('cid');
        $batch = session('batch');
        $uid = session('u_id');
        $eid = session('e_id');

        date_default_timezone_set('Asia/Dhaka');
        $ftime = date('H:i:s');

        $fdate = date('Y-m-d');

        $filepath = $request->file('file')->store('public/exam_materials/student');

        $data = array('e_id' => $eid, "u_id" => $uid, "ftime" => $ftime, "fdate" => $fdate, "file" => $filepath);
        DB::table('takes_part')->insert($data);

        return redirect()->back();

    }
    public function examscardsview(Request $request)
    {
        $cid = session('cid');
        $batch = session('batch');
        $eid = $request['e_id'];
        $uid = $request['u_id'];

        session()->put('eid', $eid);
        session()->put('uuid', $uid);

        $view = DB::select("select sgrade, takes_part.file, grade,e_title from takes_part inner join exam on takes_part.e_id=exam.e_id where exam.e_id='$eid' and u_id='$uid'");

        return view('examcardview')->with(compact('view'));

    }
    public function examscardsviewdata(Request $request)
    {
        $cid = session('cid');
        $batch = session('batch');
        $sgrade = $request['sgrade'];
        $eid = session('eid');
        $uid = session('uuid');

        DB::update("update takes_part set sgrade = $sgrade where u_id = $uid and e_id=$eid");

        return redirect()->back();
    }
    public function resources()
    {

        $cid = session('cid');
        $batch = session('batch');

        if ($cid == "") {
            return redirect('/courses');
        }

        $Total[0] = DB::select("select count(m_id) as totalvideo from records natural join study_material where c_id=$cid and batch=$batch;");
        $Total[1] = DB::select("select count(m_id) as totalslide from slides natural join study_material where c_id=$cid and batch=$batch;");
        $Total[2] = DB::select("select count(m_id) as totalbook from books natural join study_material where c_id=$cid and batch=$batch;");
        return view('course-task')->with(compact('Total'));

    }
    public function books()
    {
        $cid = session('cid');
        $batch = session('batch');

        $Books = DB::select("select *from course natural join study_material natural join books  where c_id=$cid and batch=$batch");

        return view('books')->with(compact('Books'));

    }
    public function slides()
    {
        $cid = session('cid');
        $batch = session('batch');

        $Slides = DB::select("select *from course natural join study_material natural join slides  where c_id=$cid and batch=$batch");

        return view('slides')->with(compact('Slides'));

    }
    public function records()
    {
        $cid = session('cid');
        $batch = session('batch');

        $Records = DB::select("select *from course natural join study_material natural join records  where c_id=$cid and batch=$batch");

        return view('records')->with(compact('Records'));

    }
    public function bookpreview(Request $request)
    {
        $mid = '"' . $request['m_id'] . '"';
        $prev = DB::select("select *from books where m_id=$mid");
        return view('bookpreview')->with(compact('prev'));

    }
    public function bookdelete(Request $request)
    {
        $mid = $request['m_id'];

        DB::table('books')->where('m_id', $mid)->delete();
        DB::table('study_material')->where('m_id', $mid)->delete();
        return redirect('/course-task/resources/books');

    }
    public function recordspreview(Request $request)
    {
        $mid = '"' . $request['m_id'] . '"';
        $prev = DB::select("select *from records where m_id=$mid");
        return view('recordspreview')->with(compact('prev'));

    }
    public function recordsdelete(Request $request)
    {
        $mid = $request['m_id'];

        DB::table('books')->where('m_id', $mid)->delete();
        DB::table('study_material')->where('m_id', $mid)->delete();
        return redirect('/course-task/resources/records');

    }
    public function courses()
    {
        $uid = session('u_id');

        if (session('idtype') == "Teacher") {
            $course = DB::select("select *from course natural join admincourse natural join user where u_id=$uid");
        } else {
            $res = DB::select('select * from user natural join batch where u_id = ?', [$uid]);
            $batch = $res[0]->batch;
            $course = DB::select("select *from (select *from course natural join user where batch=$batch)y natural join (select *from admincourse natural join (select c_id from enroll where u_id=$uid)X)z;");
        }

        $admincourse = DB::select("select *from admincourse ");
        return view('classroom')->with(compact('course', 'admincourse'));
    }
    public function searchteacher(Request $request)
    {
        $name = $request['name'];
        $des = $request['designition'];
        $rin = $request['rinterest'];

        $Dash = DB::select(" select *from user natural join teacher where fname= '$name' or lname = '$name' or designition = '$des' or rinterest like '%$rin%'");

        return response()->json($Dash);
    }

    public function searchstudent(Request $request)
    {
        $name = $request['name'];
        $batch = $request['batch'];
        $skills = $request['skills'];
        $bg = $request['bg'];

        $Dash = DB::select(" select *from user natural join student natural join batch where fname= '$name' or lname = '$name' or batch = '$batch' or skills like '%$skills%' or bg= '$bg'");

        return response()->json($Dash);

    }
    public function attendance()
    {
        return view('attendance');
    }
    public function attendancedata(Request $request)
    {
        $cid = 1;
        $batch = 48;
        $date = $request['date'];

        $Dash = DB::select("select  x.status as status, y.name as name, y.u_id as u_id from (select *from attendance where c_id=$cid and batch=$batch and date='$date')x right join
        (select u_id,CONCAT_WS(' ', `fname`, `lname`) AS `name` from enroll natural join user where c_id=$cid and batch=$batch order by u_id)y on x.u_id=y.u_id");

        return response()->json($Dash);
    }
    public function emergency(Request $request)
    {
        $cid = session('cid');
        if ($cid == "") {
            return redirect('/courses');
        } else {

            return view('emergency');
        }

    }
    public function emergencydata(Request $request)
    {
        $request->validate(
            [
                'msg' => 'required',
            ]
        );

        $msg = $request['msg'];
        $cid = session('cid');
        $batch = session('batch');
        $uid = session('u_id');

        $Dash = DB::select("select *from user natural join course where c_id=$cid and batch=$batch;");
        $phone = $Dash[0]->phone;

        $Stu = DB::select("select *from enroll natural join admincourse natural join user natural join student where u_id=$uid;");
        $name = $Stu[0]->fname . ' ' . $Stu[0]->lname;

        if ($Dash[0]->gender === 'Male') {
            $messege = "Dear Sir,\n" . $msg . "\n\nYours obedient,\n$name \nID - " . $Stu[0]->u_id . " \nBatch -" . $Stu[0]->batch . "\nCourse Name- " . $Stu[0]->cname;
        } else {
            $messege = "Dear Mam,\n" . $msg . "\n\nYours obedient,\n$name \nID - " . $Stu[0]->u_id . " \nBatch -" . $Stu[0]->batch . "\nCourse Name- " . $Stu[0]->cname;
        }

        $mobile = $phone;

        $apikey = "9Jeyak0/sE9w45bln46qUKqLhQ8f1GwSE+MyjAIDfsU=";
        $clientid = "24d6eae0-d29f-420a-8721-2f9b6dc4986e";
        $senderid = "8809617609933";
        $senderid = urlencode($senderid);

        $msg_type = "true";
        $messege = urlencode($messege);
        $mobilenumbers = '88' . $mobile;
        $url = "http://smsp2.durjoysoft.com/api/v2/SendSMS?ApiKey=$apikey&ClientId=$clientid&SenderId=$senderid&Message=$messege&MobileNumbers=$mobilenumbers&Is_Unicode=$msg_type";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        session()->put('msg', "Your Message Send Successfully");

        return redirect()->back();
    }
    public function archive(Request $request)
    {
        $cid = session('cid');
        if ($cid == "") {
            return redirect('/courses');
        } else {
            $batch = session('batch');
            $uid = session('u_id');

            $Sem = DB::select("select *from admincourse where c_id=$cid");
            $sem = $Sem[0]->semester;

            $Dash = DB::select("select m_id, slidename from (select distinct m_id from study_material natural join slides natural join admincourse where u_id=$uid and semester=$sem and batch!=$batch
            )x natural join slides where m_id not in (select distinct m_id from study_material natural join slides natural join admincourse where u_id=$uid and semester=$sem and batch=$batch)");

            return view('archive')->with(compact('Dash'));
        }

    }
    public function archivedata(Request $request)
    {
        $cid = session('cid');
        $batch = session('batch');
        $uid = session('u_id');

        foreach ($request['m_id_take'] as $mid) {

            $data = array('m_id' => $mid, "u_id" => $uid, "c_id" => $cid, "batch" => $batch);
            DB::table('study_material')->insert($data);
        }
        return redirect('/course-task/resources');
    }
}
