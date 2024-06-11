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
            <h3>Course Resources</h3>
            <div class="ag-courses_box">
                <div class="ag-courses_item">
                    <a href="{{ url('/') }}/course-task/resources/records" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Class Records
                        </div>

                        <div class="ag-courses-item_date-box">
                            Total class record:
                            <span class="ag-courses-item_date">
                                {{ $Total[0][0]->totalvideo }}
                            </span>
                        </div>
                    </a>
                </div>

                <div class="ag-courses_item">
                    <a href="{{ url('/') }}/course-task/resources/books" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Books
                        </div>

                        <div class="ag-courses-item_date-box">
                            Total Books:
                            <span class="ag-courses-item_date">
                                {{ $Total[2][0]->totalbook }}
                            </span>
                        </div>
                    </a>
                </div>


                <div class="ag-courses_item">
                    <a href="{{ url('/') }}/course-task/resources/slides" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Slides
                        </div>

                        <div class="ag-courses-item_date-box">
                            Total slides:
                            <span class="ag-courses-item_date">
                                {{ $Total[1][0]->totalslide }}
                            </span>
                        </div>
                    </a>
                </div>

                <div class="ag-courses_item">
                    <a href="{{ url('/') }}/course-task/exams" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                            Classworks
                        </div>

                        <div class="ag-courses-item_date-box">
                            Total classworks:
                            <span class="ag-courses-item_date">
                                125
                            </span>
                        </div>
                    </a>
                </div>





            </div>
        </div>
    </div>
@endsection
