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
                @if(session('idtype')=='Teacher')
                <li class="active" style="margin-left:1rem;cursor:pointer"> <a data-toggle="modal"
                        data-target="#announcement">
                        Create Exam
                    </a></li>
                    @endif

            </ul>

        </div>
        <div class="modal fade" id="announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Take an Exam</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/') }}/course-task/exams/data" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Title of the exam:</label>
                                <input type="text" class="form-control" value="{{ old('title') }}" name="title"
                                    id="" aria-describedby="emailHelpId" placeholder="Enter exam title"
                                    autocomplete="off" required>
                                <span class="text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Grade:</label>
                                <input type="text" class="form-control" value="{{ old('grade') }}" name="grade"
                                    id="" aria-describedby="emailHelpId" placeholder="Enter grade"
                                    autocomplete="off" required>
                                <span class="text-danger">
                                    @error('grade')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Ending time:</label>
                                <input type="time" class="form-control" value="{{ old('etime') }}" name="etime"
                                    id="" aria-describedby="emailHelpId" autocomplete="off" required>
                                <span class="text-danger">
                                    @error('etime')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Ending Date:</label>
                                <input type="date" class="form-control" value="{{ old('edate') }}" name="edate"
                                    id="" aria-describedby="emailHelpId" autocomplete="off" required>
                                <span class="text-danger">
                                    @error('edate')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Exam Details:</label>
                                <textarea class="form-control" name="edetails" id="exampleFormControlTextarea1" rows="7"
                                    placeholder="Instructions"></textarea>
                                <span class="text-danger">
                                    @error('edetails')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Exam Details:</label>
                                <input type="file" class="form-control" name="file" id=""
                                    aria-describedby="emailHelpId">

                            </div>
                            <div class="card">
                                <button class="btn btn-primary" style="width:13rem;background:#1E2772;">Upload
                                    Everything</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <h3 style="font-weight:bold;margin-top:1rem">Course Exams</h3>
        <div class="row py-3">

            @foreach ($Exams as $item)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->e_title }}</h5>
                            <p class="card-text">Due time: <span
                                    style="color:orange">{{ date('h:i:s a', strtotime($item->etime)) }} -
                                    {{ date('d, F - Y', strtotime($item->edate)) }}</span></p>
                            <div style="display:flex;justify-content:space-between"><a
                                    href="@if(session('idtype')=='Teacher'){{ url('/') }}/course-task/exams/cards?e_id={{ $item->e_id }}@endif @if(session('idtype')=='Student'){{ url('/') }}/course-task/exams/stu?e_id={{ $item->e_id }} @endif"
                                    class="btn btn-success">Continue</a>
                                @if (session('idtype') == 'Student')
                                @if($item->sgrade=="")
                                    <p>Marks obtained: <span style="color:blue;font-weight:bolder">..../{{$item->grade}}</span></p>
                                    @else 
                                    <p>Marks obtained: <span style="color:blue;font-weight:bolder">{{$item->sgrade}}/{{$item->grade}}</span></p>
                                    @endif
                                    
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endsection
