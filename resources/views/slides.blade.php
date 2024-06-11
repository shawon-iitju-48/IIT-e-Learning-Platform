@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/course-task.css') }}">
    <div class="course-task" id="ok">
        <div class="headerr">
            <ul class="nav nav-pills">
                <li id="d" style="margin-right:1rem;cursor:pointer"><a
                        href="{{ url('/') }}/course-task?c_id={{ session('cid') }} & batch={{ session('batch') }}">Announcements</a>
                </li>
                
                <li class="active"><a
                        href="{{ url('/') }}/course-task/resources">Resources</a>
                </li>
                <li ><a
                        href="{{ url('/') }}/course-task/exams">Exams</a>
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
            <h3>Slides</h3>
            <div class="ag-courses_box">
                @foreach($Slides as $item)
                <div class="ag-courses_item">
                    <a href="/storage/{{ explode('/', $item->slidepath, 2)[1] }}" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            {{$item->slidename}}
                        </div>

                        <div class="ag-courses-item_date-box" style="display:flex">
                         <h4 style="font-weight:bold" class="btn btn-primary">Download</h4>
                            
                        </div>
                    </a>
                </div>
@endforeach
            </div>
        </div>
    </div>
    
@endsection
