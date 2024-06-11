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
                <li class="active"><a
                        href="{{ url('/') }}/course-task/exams/cards?e_id={{ session('eid') }}">{{ $view[0]->e_title }}</a>
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
        <h3 style="font-weight:bold;margin-top:1rem">Submitted PDF</h3>
        <form action="{{ url('/') }}/course-task/exams/cards/view/data" method="post">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Grading :</label>
                <input type="text" class="form-control text-success" name="sgrade" aria-describedby="idHelpId"
                    value="{{ $view[0]->sgrade }}" placeholder="Pleas grade out of {{ $view[0]->grade }}" required>
                <span class="text-danger">
                    @error('sgrade')
                        {{ $message }}
                    @enderror
                    <span>
            </div>

            <button class="btn btn-primary" style="width:13rem;background:#1E2772;">Update grade</button>

        </form>
        <div class="row py-3">
            @if ($view[0]->file != '')
                <embed type="application/pdf" src="/storage/{{ explode('/', $view[0]->file, 2)[1] }}" width="50%"
                    height="842px">
            @endif
        </div>
    </div>
@endsection
