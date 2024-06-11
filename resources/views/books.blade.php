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
            <h3>Books</h3>
            <div class="ag-courses_box">
                @foreach($Books as $item)
                <div class="ag-courses_item">
                    <a href="{{ url('/') }}/course-task/resources/books/preview?m_id={{$item->m_id}}" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            {{$item->bookname}}
                        </div>

                        <div class="ag-courses-item_date-box" style="display:flex">
                            <i style="color:#0EA293;font-size:2rem;margin-right:0.5rem;" class="fas fa-door-open"></i>
                           <h4 style="color:#0EA293;font-weight:bold">Continue</h4>
                            
                        </div>
                    </a>
                </div>
@endforeach
            </div>
        </div>
    </div>
    
@endsection
