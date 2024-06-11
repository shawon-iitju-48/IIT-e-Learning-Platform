<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;

class LoginSignupForm extends Controller
{

    public function VerifyLogin(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $email = $request['email'];
        $request->session()->flash('tempmail', $email);
        $password = $request['password'];
        $result = UserModel::where('email', $email)->get();
        if (count($result) > 0) {
            if (Hash::check($password, $result[0]->password)) {
                session()->put('u_id', $result[0]->u_id);
                $uid = session('u_id');
                $goa = DB::select("select *from user where u_id=$uid;");
                $namep = $goa[0]->fname . ' ' . $goa[0]->lname;
                session()->put('name', $namep);
                session()->put('dp', $goa[0]->dp);
                return redirect('/home');

            } else {
                $request->session()->flash('errorpass', 'Please enter correct password.');
                return redirect()->back();
            }
        } else {
            $goa = DB::select("select *from admin where email='$email' and password='$password';");
            if (count($goa) > 0)
            {
                session()->put('adminemail', $goa[0]->email);
                return redirect('/iitadmin');
            }
            $request->session()->flash('erroremail', 'Please enter valid email.');
            return redirect()->back();
        }

    }

    public function insert(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => ['required', Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers(), 'same:cpassword'],
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required',
                'dp' => 'required|image',
                'idcard' => 'required|image',
                'gender' => 'required',
                'u_id' => 'required|numeric',
            ]
        );

        $newuser = new UserModel();
        $newuser->u_id = $request['u_id'];
        $newuser->email = $request['email'];
        $newuser->fname = $request['fname'];
        $newuser->lname = $request['lname'];
        $newuser->bg = $request['bg'];
        $newuser->phone = $request['phone'];
        $newuser->password = Hash::make($request['password']);
        $newuser->gender = $request['gender'];
        $newuser->dp = $request->file('dp')->store('public/dbstorage/images');
        $newuser->id_image = $request->file('idcard')->store('public/dbstorage/images');

        $newuser->save();
        return redirect('/login');

    }

    public function signup()
    {
        if (session()->has('u_id')) {
            return redirect('/home');
        } else {
            return view('usersignup');
        }

    }
    public function login()
    {
        if (session()->has('u_id')) {
            return redirect('/home');
        } else {
            return view('userlogin');
        }

    }
    public function logout()
    {
        session()->forget('u_id');
        session()->forget('adminemail');
        return redirect('/login');
    }
}
