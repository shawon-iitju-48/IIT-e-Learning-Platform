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
                <li><a href="{{ url('/') }}/course-task/archive">Archive</a>
                </li>
            @endif
            </ul>
        </div>
        <h3 style="font-weight:bold;margin-top:1rem">Take Attendance</h3>
        <div style="width:20%"><input type="date" id="date" class="form-control text-success"></div>

        <button id="load" style="margin-top:1rem;width:20%" class="btn btn-primary">Load</button>

        <div class="row py-3" id="con" style="width:80%">

        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#load").click(function() {
                var s = $('#date').val();
                $.ajax({
                    url: "attendance/data",
                    method: "POST",
                    data: {
                        date: s,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data)

                        var code = "";
                        code += '<table class="table table-striped">';
                        code += '\t\t\t\t<thead>';
                        code += '\t\t\t\t\t<tr>';
                        code += '\t\t\t\t\t\t<th scope="col">Roll</th>';
                        code += '\t\t\t\t\t\t<th scope="col">Name</th>';
                        code += '\t\t\t\t\t\t<th scope="col">';
                        code += '\t\t\t\t\t\t\t<div class="form-check">';
                        code +=
                            '\t\t\t\t\t\t\t\t<input name="all" class="form-check-input" type="checkbox" value=""';
                        code += '\t\t\t\t\t\t\t\t\tid="all">';
                        code +=
                            '\t\t\t\t\t\t\t\t<label class="form-check-label" for="flexCheckDefault">';
                        code += '\t\t\t\t\t\t\t\t\tAll present';
                        code += '\t\t\t\t\t\t\t\t</label>';
                        code += '\t\t\t\t\t\t\t</div>';
                        code += '\t\t\t\t\t\t</th>';
                        code += '\t\t\t\t\t</tr>';
                        code += '';
                        code += '\t\t\t\t</thead>';
                        code += '\t\t\t\t<tbody>';
                        for (var i = 0; i < data.length; i++) {
                            code += '\t\t\t\t\t<tr>';
                            code += '\t\t\t\t\t\t<td>' + data[i]['u_id'] + '</td>';
                            code += '\t\t\t\t\t\t<td>' + data[i]['name'] + '</td>';
                            code += '\t\t\t\t\t\t<td>';
                            code += '\t\t\t\t\t\t\t<div class="form-check">';
                            code +=
                                '\t\t\t\t\t\t\t\t<input name="ok" id="' + data[i]['u_id'] +
                                '" class="form-check-input" type="checkbox" value="" >';
                            code += '\t\t\t\t\t\t\t</div>';
                            code += '\t\t\t\t\t\t</td>';
                            code += '\t\t\t\t\t</tr>';

                            if (data[i]['status'] == "0") {
                                
                                let a = "#" + data[i]['u_id'];
                                console.log(a);
                                $('input[name=ok]').prop('checked', true)
                                console.log($('input[name=ok]').html())

                            }

                        }
                        code += '\t\t\t\t</tbody>';
                        code += '';
                        code += '\t\t\t</table>';

                        $("#con").html(code);
                    }
                });
            });

        });
    </script>
@endsection
