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
                <li class="active" style="margin-right:1rem;"><a href="{{ url('/') }}/course-task/exams">Exams</a>
                </li>
                @if (session('idtype') == 'Teacher')
                <li><a href="{{ url('/') }}/course-task/attendance">Attendance</a>
                </li>
                @endif
                @if (session('idtype') == 'Student')
                    <li><a href="{{ url('/') }}/course-task/emergency">Emergency Message</a>
                    </li>
                @endif
                @if (empty($Card[1]))
                    <li class="active" style="margin-right:1rem;cursor:pointer"> <a data-toggle="modal"
                            data-target="#announcement">
                            Submit Your Answer
                        </a></li>
                @endif
                <div class="modal fade" id="announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Submit Answer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/') }}/course-task/exams/stu/data" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Your PDF:</label>
                                        <input type="file" class="form-control text-success" name="file"
                                            id="" aria-describedby="idHelpId" required>
                                    </div>

                                    <div class="card">
                                        <button class="btn btn-primary" style="width:50%;background:#1E2772;">Submit Your
                                            PDF File</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </ul>

        </div>
        <h3 style="font-weight:bold;margin-top:1rem">{{ $Card[0][0]->e_title }}</h3>
        @if ($Card[0][0]->e_details != '')
            <h5 style="color:orange">Instructions:</h5><b>{{ $Card[0][0]->e_details }}</b>
        @endif
        <div class="py-2" style="display:flex">
            <div class="row py-1">
                <h5 style="color:orange;margin-right:1rem;">Due time:</h5><b>{{ $Card[0][0]->etime }}</b>
            </div>
            <div class="row py-1">
                <h5 style="color:orange;margin-right:1rem;">Due date:</h5><b>{{ $Card[0][0]->edate }}</b>
            </div>

            <div class="row py-1">

                <h5 style="color:orange;margin-right:1rem;">Status:</h5>
                @if (empty($Card[1]))
                    <b>Not submitted yet</b>
                @endif
                @if (!empty($Card[1]))
                    @if ($Card[1][0]->fdate <= $Card[0][0]->edate && $Card[1][0]->ftime <= $Card[0][0]->etime)
                        <b>Turned In</b>
                    @else
                        <b>Turned In Late</b>
                    @endif
                @endif
            </div>

        </div>

        <div class="row py-3 ">
            @if ($Card[0][0]->file != '')
                <embed type="application/pdf" src="/storage/{{ explode('/', $Card[0][0]->file, 2)[1] }}" width="20%"
                    height="842px">
            @endif
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
