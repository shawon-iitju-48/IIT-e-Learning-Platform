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
            <h3>Book preview</h3>
            <div class="ag-courses_box">
                <embed type="application/pdf" src="/storage/{{ explode('/', $prev[0]->bookpath, 2)[1] }}" width="80%" height="842px">
                    @if(session('idtype')=='Teacher')
                <a style="margin-left:1rem" href="{{ url('/') }}/course-task/resources/books/delete?m_id={{$prev[0]->m_id}}" class="btn btn-primary">Delete this book</a>
           @endif
            </div>
        </div>
    </div>
@endsection
