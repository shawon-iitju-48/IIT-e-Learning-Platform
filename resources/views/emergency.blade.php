@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/course-task.css') }}">
    <div class="exam" style="min-height:90vh">
        <div class="headerr">
            <ul class="nav nav-pills">
                <li id="d" style="margin-right:1rem;cursor:pointer"><a
                        href="{{ url('/') }}/course-task?c_id={{ session('cid') }} & batch={{ session('batch') }}">Announcements</a>
                </li>
                <li><a href="{{ url('/') }}/course-task/resources">Resources</a>
                </li>
                <li style="margin-right:1rem;cursor:pointer"><a href="{{ url('/') }}/course-task/exams">Exams</a>
                </li>
                @if (session('idtype') == 'Teacher')
                    <li><a href="{{ url('/') }}/course-task/attendance">Attendance</a>
                    </li>
                @endif
                @if (session('idtype') == 'Student')
                    <li class="active"><a href="{{ url('/') }}/course-task/emergency">Emergency Message</a>
                    </li>
                @endif
                @if (session('idtype') == 'Teacher')
                    <li><a href="{{ url('/') }}/course-task/archive">Archive</a>
                    </li>
                @endif
            </ul>
        </div>
        @if (session()->has('msg'))
            <div id="ban" class="alert alert-primary" role="alert">
                {{ Session::get('msg') }}
            </div>
        @endif
        <h3 style="font-weight:bold;margin-top:1rem">Send Emergency Message</h3>

        <form action="{{ url('/') }}/course-task/emergency/data" method="post" enctype="multipart/form-data">
            @csrf
            <textarea class="form-control" name="msg" id="exampleFormControlTextarea1" rows="10"
                placeholder="Enter your post here" required></textarea>
            <span class="text-danger">
                @error('msg')
                    {{ $message }}
                @enderror
                <span>
                    <div class="box">
                        <div class="input-group mb-3 py-3" style="width:100%">
                            <button type="submit" class="btn btn-success">Send Your Message</button>
                        </div>
                    </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {

            $("#ban").click(function() {
                {{ session()->forget('msg') }}
                $("#ban").addClass('hidee')
            });


        });
    </script>
@endsection
