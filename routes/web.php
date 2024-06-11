<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', 'App\Http\Controllers\LoginSignupForm@signup');
Route::post('/signup/data', 'App\Http\Controllers\LoginSignupForm@insert');

Route::get('/login', 'App\Http\Controllers\LoginSignupForm@login');
Route::post('/login/verify', 'App\Http\Controllers\LoginSignupForm@VerifyLogin');

Route::get('/logout', 'App\Http\Controllers\LoginSignupForm@logout');

Route::get('/home', 'App\Http\Controllers\Management@home')->middleware('loginauth');
Route::post('/home/data', 'App\Http\Controllers\Management@coursecard')->middleware('loginauth');
Route::post('/home/data/t', 'App\Http\Controllers\Management@coursecardt')->middleware('loginauth');
Route::post('/home/calander', 'App\Http\Controllers\Management@calander')->middleware('loginauth');
Route::post('/home/calander/stu', 'App\Http\Controllers\Management@calanderstu')->middleware('loginauth');

Route::get('/profile', 'App\Http\Controllers\Management@profile')->middleware('loginauth');
Route::post('/profile/data', 'App\Http\Controllers\QueryManagement@updateprofile')->middleware('loginauth');
Route::post('/profile/tdata', 'App\Http\Controllers\QueryManagement@updatetprofile')->middleware('loginauth');

Route::get('/courses', 'App\Http\Controllers\Management@courses')->middleware('loginauth');
Route::post('/courses/data', 'App\Http\Controllers\QueryManagement@coursesdata')->middleware('loginauth');
Route::post('/courses/stu/data', 'App\Http\Controllers\QueryManagement@coursesstudata')->middleware('loginauth');

Route::prefix('/course-task')->group(function () {
    Route::get('/', 'App\Http\Controllers\Management@discussion')->middleware('loginauth');
    Route::post('/file/data', 'App\Http\Controllers\QueryManagement@teacherfile')->middleware('loginauth');
    Route::post('/data', 'App\Http\Controllers\QueryManagement@teacherpost')->middleware('loginauth');

    Route::get('exams', 'App\Http\Controllers\Management@exams')->middleware('loginauth');

    Route::post('exams/data', 'App\Http\Controllers\Management@examsup')->middleware('loginauth');
    Route::get('exams/cards', 'App\Http\Controllers\Management@examscards')->middleware('loginauth');
    Route::get('exams/stu', 'App\Http\Controllers\Management@examsstu')->middleware('loginauth');
    Route::post('exams/stu/data', 'App\Http\Controllers\Management@examsstudata')->middleware('loginauth');
    Route::get('exams/cards/view', 'App\Http\Controllers\Management@examscardsview')->middleware('loginauth');
    Route::post('exams/cards/view/data', 'App\Http\Controllers\Management@examscardsviewdata')->middleware('loginauth');

    Route::get('resources', 'App\Http\Controllers\Management@resources')->middleware('loginauth');
    Route::get('emergency', 'App\Http\Controllers\Management@emergency')->middleware('loginauth');
    Route::post('emergency/data', 'App\Http\Controllers\Management@emergencydata')->middleware('loginauth');

    Route::get('archive', 'App\Http\Controllers\Management@archive')->middleware('loginauth');
    Route::post('archive/data', 'App\Http\Controllers\Management@archivedata')->middleware('loginauth');

    Route::get('resources/books', 'App\Http\Controllers\Management@books')->middleware('loginauth');
    Route::get('resources/books/preview', 'App\Http\Controllers\Management@bookpreview')->middleware('loginauth');
    Route::get('resources/books/delete', 'App\Http\Controllers\Management@bookdelete')->middleware('loginauth');

    Route::get('resources/slides', 'App\Http\Controllers\Management@slides')->middleware('loginauth');

    Route::get('resources/records', 'App\Http\Controllers\Management@records')->middleware('loginauth');
    Route::get('resources/records/preview', 'App\Http\Controllers\Management@recordspreview')->middleware('loginauth');
    Route::get('resources/records/delete', 'App\Http\Controllers\Management@recordsdelete')->middleware('loginauth');

});

Route::get('/searchteacher', function () {
    return view('searchbyteacher');
});
Route::post('/searchteacher/data', 'App\Http\Controllers\Management@searchteacher');

Route::get('/searchstudent', function () {
    return view('searchbystudent');
});
Route::post('/searchstudent/data', 'App\Http\Controllers\Management@searchstudent');

Route::get('/attendance', 'App\Http\Controllers\Management@attendance')->middleware('loginauth');
Route::post('/attendance/data', 'App\Http\Controllers\Management@attendancedata')->middleware('loginauth');


Route::prefix('/iitadmin')->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin@home')->middleware('loginauth');
    Route::get('/course', 'App\Http\Controllers\Admin@course')->middleware('loginauth');
    Route::post('/search/data', 'App\Http\Controllers\Admin@searchdata')->middleware('loginauth');
    Route::post('/update/data', 'App\Http\Controllers\Admin@updatedata')->middleware('loginauth');
    Route::post('/excel/data', 'App\Http\Controllers\Admin@excel')->middleware('loginauth');
});
