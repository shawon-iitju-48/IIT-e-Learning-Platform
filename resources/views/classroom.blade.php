@extends('layout.master')
@section('content')
    {{-- not responsive --}}
    <div class="hed">
        <h3>Your Courses</h3>
        <hr class="new5">
        <div style="margin-top:1.8rem;margin-left:15rem;cursor:pointer">
            @if (session('idtype') == 'Teacher')
                <button class="btn btn-primary" data-toggle="modal" data-target="#announcement">
                    Create Classroom
                </button>
            @endif
            @if (session('idtype') == 'Student')
                <button class="btn btn-primary" data-toggle="modal" data-target="#join">
                    Join Classroom
                </button>
            @endif
        </div>
        <div class="modal fade" id="announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Classroom</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="createform" action="{{ url('/') }}/courses/data" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="" class="form-label">Course Title:</label>
                                <select style="cursor:pointer" name="cname" class="form-select"
                                    aria-label="Default select example" required>
                                    <option>Select Your Course</option>
                                    @foreach ($admincourse as $item)
                                        <option value="{{ $item->c_id }}">{{ $item->cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input id="cid" type="text" class="form-control" value="" name="cid"
                                    id="" aria-describedby="emailHelpId" autocomplete="off" hidden>

                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">For Which Batch:</label>
                                <input type="text" class="form-control" value="{{ old('batch') }}" name="batch"
                                    id="" aria-describedby="emailHelpId" autocomplete="off" required>
                            </div>
                            <div class="card">
                                <button class="btn btn-primary" style="width:100%;background:#1E2772;">Create</button>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- <button style="margin-top:1.6rem;margin-left:15rem;" class="btn btn-primary">Create Classroom</button> --}}
        <div class="modal fade" id="join" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Join Classroom</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="joinform" action="{{ url('/') }}/courses/stu/data" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="" class="form-label">Course Title:</label>
                                <select style="cursor:pointer" name="cname1" class="form-select"
                                    aria-label="Default select example" required>
                                    <option>Select Course</option>
                                    @foreach ($admincourse as $item)
                                        <option value="{{ $item->c_id }}">{{ $item->cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input id="cid1" type="text" class="form-control" value="" name="cid1"
                                    aria-describedby="emailHelpId" autocomplete="off" hidden>

                            </div>

                            <div class="card">
                                <button class="btn btn-primary" style="width:100%;background:#1E2772;">Join
                                    Classroom</button>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="classroom">
        @foreach ($course as $item)
            <div class="course">
                <div class="course-preview">
                    <h6 style="color:white">Course</h6>
                    <h2 style="color:white">{{ $item->cname }}</h2>
                    <a href="#"> </a>
                </div>
                <div class="course-info">
                    <div class="progress-container">
                        <div>Batch</div>
                        <span class="progress-text">
                            {{ $item->batch }}
                        </span>
                    </div>
                    <h6>Instructor</h6>
                    <h2>{{ $item->fname }} {{ $item->lname }}</h2>
                    <button class="btn"
                        onclick="window.location.href='{{ url('/') }}/course-task?c_id={{ $item->c_id }} & batch={{ $item->batch }}';">Continue</button>
                </div>
            </div>
        @endforeach


    </div>
    <script>
        $(document).ready(function() {
            $("form[name=createform] select[name='cname']").on('change', function() {
                var xd=this.value;
                $('input[name=cid]').val(xd)
            });
            $("form[name=joinform] select[name='cname1']").on('change', function() {
                var xd=this.value;
                $('input[name=cid1]').val(xd)
            });

        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
