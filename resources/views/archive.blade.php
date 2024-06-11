@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/course-task.css') }}">
    <div class="exam" style="min-height:90vh">
        <div class="headerr">
            <ul class="nav nav-pills">
                <li id="d" style="margin-right:1rem;cursor:pointer"><a
                        href="{{ url('/') }}/course-task?c_id={{ session('cid') }} & batch={{ session('batch') }}">Announcements</a>
                </li>
                <li><a href="{{ url('/') }}/course-task/resources">Resources</a>
                </li>
                <li style="margin-right:1rem;cursor:pointer"><a href="{{ url('/') }}/course-task/exams">Exams</a>
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
                    <li class="active"><a href="{{ url('/') }}/course-task/archive">Archive</a>
                    </li>
                @endif
            </ul>
        </div>
        <h3 style="font-weight:bold;margin-top:1rem">Import Content</h3>

        <div class="col-10">
            <form action="{{ url('/') }}/course-task/archive/data" method="post">
                @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th scope="col">Name</th>
                            <th scope="col">Assign</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($Dash))
                       
                        @foreach ($Dash as $item)
                    <tr>
                        <td>
                            {{$item->slidename}}
                        </td>
                       
                        <td>  <input type="checkbox" name="m_id_take[]" value=" {{$item->m_id}}"></td>
                    </tr>
                    @endforeach
                    @else
                    <div  class="alert alert-primary py-5" role="alert">
                        There are no more slides available to import in.
                    </div>
                    @endif
                    </tbody>
                </table>
                <div class="card">
                    <button class="btn btn-primary" style="background:#1E2772;">Import</button>
                </div>
            </form>
        </div>
    </div>
@endsection
