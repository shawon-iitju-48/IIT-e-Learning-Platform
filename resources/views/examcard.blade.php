@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/course-task.css') }}">
    <div class="exam">
        <div class="headerr">
            <ul class="nav nav-pills">
                <li id="d" style="margin-right:1rem;cursor:pointer"><a
                        href="{{ url('/') }}/course-task?c_id={{ session('cid') }} & batch={{ session('batch') }}">Announcements</a>
                </li>
                <li><a href="{{ url('/') }}/course-task/resources">Resources</a>
                </li>
                <li class="active"><a href="{{ url('/') }}/course-task/exams">Exams</a>
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
        <h3 style="font-weight:bold;margin-top:1rem">{{$Card[2][0]->e_title}}</h3>
        <div class="row py-3">

            <div class="col-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Submitted</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Card[0] as $item)
                        <tr>
                            <td>
                                <span class="user-img">
                                    <img class="rounded-circle" src="/storage/{{ explode('/', $item->dp, 2)[1] }}" width="31"alt="aa">
                                    <div class="user-text">
                                        <h6>{{$item->fname}} {{$item->lname}}</h6>
                                        <p class="text-muted mb-0">ID: {{$item->u_id}}</p>
                                        @if($item->sgrade!="")
                                        <p style="color:orange" class=" mb-0">Graded</p>
                                        @endif
                                </span>
                            </td>
                            <td><a href="{{ url('/') }}/course-task/exams/cards/view?e_id={{$item->e_id}} & u_id={{$item->u_id}}" class="btn btn-primary">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Missing</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Card[1] as $item)
                        
                        <tr>
                            <td><span class="user-img">
                                <img class="rounded-circle" src="/storage/{{ explode('/', $item->dp, 2)[1] }}" width="31"alt="aa">
                                <div class="user-text">
                                    <h6>{{$item->fname}} {{$item->lname}}</h6>
                                    <p class="text-muted mb-0">ID: {{$item->u_id}}</p>
                            </span></td>
                            <td>-------</td>
                        </tr>
                        @endforeach
                        
                        
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
