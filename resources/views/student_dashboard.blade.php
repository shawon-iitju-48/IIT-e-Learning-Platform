@extends('layout.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Welcome {{$DashInfo[5][0]->lname}}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}/home">Home</a></li>
                                <li class="breadcrumb-item active">Student</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{print_r($DashInfo)}} --}}
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Course in Progress</h6>
                                    <h3>{{ $DashInfo[0][0]->inprogress }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Course Completed</h6>
                                    <h3>{{ $DashInfo[1][0]->completed }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Total Exam</h6>
                                    <h3>{{$DashInfo[7][0]->totalexam}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Exam Attended</h6>
                                    <h3>{{$DashInfo[6][0]->totalgiven}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-8">
                    <div id="prity" class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Courses You are Taking</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">

                                        <li class="lesson-view-all"><a href="{{ url('/') }}/courses">View All</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="dash-circle">
                            <div class="row">
                                <div id="cstatus" class="col-lg-3 col-md-3 dash-widget1">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="{{ $DashInfo[2][0]->cstatus }}">
                                            <b>{{ $DashInfo[2][0]->cstatus }}%</b>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-lg-3 col-md-3">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-02.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Course Code</h5>
                                                <h4 id="cid">ICT-{{ $DashInfo[2][0]->c_id }}</h4>
                                            </div>
                                        </div>
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-01.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Course Title</h5>
                                                <h4 id="cname">{{ $DashInfo[2][0]->cname }}</h4>
                                            </div>
                                        </div>

                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-03.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Semester</h5>
                                                <h4 id="sname">{{ $DashInfo[2][0]->sname }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-05.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Instructor</h5>
                                                <h4 id="instructor">
                                                    {{ $DashInfo[2][0]->fname . ' ' . $DashInfo[2][0]->lname }}</h4>
                                            </div>
                                        </div>
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-04.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Asignment Done</h5>
                                                <h4>05/20</h4>
                                            </div>
                                        </div>

                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="{{ URL::to('assets/img/icons/lesson-icon-06.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Exam Attended</h5>
                                                <h4>10/50</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 d-flex align-items-center justify-content-center">
                                    <div class="skip-group">

                                        <button id="nextbtn" class="btn btn-info skip-btn">Next</button>

                                        <button id="{{ $DashInfo[2][0]->c_id . '_' . $DashInfo[2][0]->batch }}"
                                            class="btn btn-info continue-btn gotoclassroom">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12 col-lg-12 col-xl-12 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title">Course History</h5>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="teaching-card">
                    
                                        <ul class="activity-feed">
                                            @foreach ($DashInfo[3] as $item)
                                                <li class="feed-item d-flex align-items-center">
                                                    <div class="dolor-activity">
                                                        <span class="feed-text1"><a>{{ $item->cname }}</a></span>
                                                        <ul class="teacher-date-list">
                                                            <li><i
                                                                    class="fas fa-calendar-alt me-2"></i>{{ $item->creation }}
                                                            </li>
                                                            <li>|</li>
                                                            <li><i class="fas fa-clock me-2"></i>{{ $item->sname }}</li>
                                                        </ul>
                                                    </div>
                                                    <a href="{{url('/')}}/course-task?c_id={{$item->c_id}} & batch={{$item->batch}}">
                                                    <div class="activity-btns ms-auto">
                                                        <button  class="btn btn-info">
                                                            @if ($item->cstatus == '100')
                                                                Completed
                                                            @endif
                                                            @if ($item->cstatus != '100')
                                                            In Progress
                                                        @endif
                                                             
                                                        </button>
                                                    </a>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-4 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-body">
                            <div id="calendar-doctor" class="calendar-container"></div>
                            <div class="calendar-info calendar-info1">
                                <div class="up-come-header">
                                    <h2>Upcoming Events</h2>
                                </div>
                                @foreach ($DashInfo[4] as $item)
                                @if(session('idtype')=="Teacher")
                                <a href="{{url('/')}}/course-task/exams/cards?e_id={{$item->e_id}}">
                                    @else 
                                    <a href="{{url('/')}}/course-task/exams/stu?e_id={{$item->e_id}}">
                                    @endif
                                <div class="calendar-details">
                                    <p>{{$item->batch}} Batch</p>
                                    <div class="calendar-box normal-bg">
                                        <div class="calandar-event-name">
                                            <h4>{{$item->e_title}}</h4>
                                            <h5>ICT-{{$item->c_id}}</h5>
                                        </div>
                                        <span>{{$item->sdate}} to {{$item->edate}}</span>
                                    </div>
                                </div>
                            </a>
                                @endforeach
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var index = 0;
        $(document).ready(function() {
            $("#nextbtn").click(function() {
                index++;
                console.log(index)
                $.ajax({
                    url: "home/data",
                    method: "POST",
                    data: {
                        offset: index,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
                    success: function(data) {
                        $("#cid").html("ICT-" + data[0]['c_id']);
                        $("#cname").html(data[0]['cname']);
                        $("#sname").html(data[0]['sname']);
                        $("#instructor").html(data[0]['fname'] + ' ' + data[0]['lname']);

                        let code = "";
                        code += '<div class="circle-bar circle-bar2">';
                        code +=
                            '<div class="circle-graph2" data-percent="' +
                            data[0]['cstatus'] + '">';
                        code += '<b>' + data[0]['cstatus'] + '%</b>';
                        code += '</div>';
                        code += '</div>';
                        $("#cstatus").html(code);
                        window.scrollBy(0, 1);
                        $(".gotoclassroom").prop('id', data[0]['c_id'] + '_' + data[0][
                            'batch'
                        ]);


                    }
                });
            });
            $(".gotoclassroom").click(function() {
                let myArray = this.id.split("_", 2);
                window.location = '/course-task?c_id=' + myArray[0] + ' & batch=' + myArray[1];
            });

            var events;
            $.ajax({
                url: "home/calander/stu",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                cache: false,
                success: function(data) {
                    myfunction(data)

                }
            });

            function myfunction(data) {
                events = data;
                $("#calendar-doctor").simpleCalendar({
                    fixedStartDay: 0,
                    disableEmptyDetails: true,
                    events,

                });

            }
        });
    </script>
@endsection
