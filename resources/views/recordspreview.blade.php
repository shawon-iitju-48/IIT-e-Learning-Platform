@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/course-task.css') }}">
    <div class="course-task" id="ok">
        <div class="headerr">
            <ul class="nav nav-pills">
                <li id="d" style="margin-right:1rem;cursor:pointer"><a
                        href="{{ url('/') }}/course-task?c_id={{ session('cid') }} & batch={{ session('batch') }}">Announcements</a>
                </li>

                <li class="active"><a href="{{ url('/') }}/course-task/resources">Resources</a>
                </li>
                <li><a href="{{ url('/') }}/course-task/exams">Exams</a>
                </li>
                @if (session('idtype') == 'Teacher')
                <li><a href="{{ url('/') }}/course-task/attendance">Attendance</a>
                </li>
                @endif
                @if (session('idtype') == 'Student')
                    <li><a href="{{ url('/') }}/course-task/emergency">Emergency Message</a>
                    </li>
                @endif
                @if (session('idtype') == 'Teacher')
                <li><a href="{{ url('/') }}/course-task/archive">Archive</a>
                </li>
            @endif

            </ul>

        </div>
        <div class="ag-format-container">
            <h3>Class record preview</h3>
            @if(session('idtype')=='Teacher')
            <div class="ag-courses_box">
                <a style="justify-content:right" href="{{ url('/') }}/course-task/resources/records/delete?m_id={{$prev[0]->m_id}}" class="btn btn-primary">Delete this record</a>
            </div>
            @endif
                <video src="/storage/{{ explode('/', $prev[0]->videopath, 2)[1] }}" width="900" height="500" controls>
                   
                    </video>
               
               
        </div>
    </div>
@endsection
