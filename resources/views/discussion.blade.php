@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/course-task.css') }}">
    <div class="course-task" id="ok">
        <div class="headerr">
            <ul class="nav nav-pills">
                <li class="active" id="d" style="margin-right:1rem;cursor:pointer"><a
                        href="{{ url('/') }}/course-task?c_id={{ session('cid') }} & batch={{ session('batch') }}">Announcements</a>
                </li>
                @if (session('idtype') == 'Teacher')
                    <li class="active" style="margin-right:1rem;cursor:pointer"> <a data-toggle="modal"
                            data-target="#announcement">
                            Announce Something
                        </a></li>
                    <li class="active" style="margin-right:1rem;cursor:pointer"> <a data-toggle="modal"
                            data-target="#resourceupload">
                            Upload Resources
                        </a></li>
                @endif
                <li><a href="{{ url('/') }}/course-task/resources">Resources</a>
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
        <section>
            <h3 style="font-weight:bold;margin-top:1rem"><span>Course Title: </span>{{ $Discussion[1][0]->cname }} | Batch:
                {{ $Discussion[1][0]->batch }}</h3>
            <div class="container my-1 py-2">
                <div class="modal fade" id="announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Announce Something to Class</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/') }}/course-task/data" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <textarea class="form-control" name="post_content" id="exampleFormControlTextarea1" rows="10"
                                        placeholder="Enter your post here" required></textarea>
                                    <span class="text-danger">
                                        @error('post_content')
                                            {{ $message }}
                                        @enderror
                                        <span>
                                            <br />

                                            <div class="buttons">
                                                <div class="post_btn">
                                                    <button type="submit" id="post_id" class="btn btn-info"
                                                        style="border:1px solid white;width:10rem;">
                                                        <span class="button__icon">
                                                            Announce it
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="buttons"></div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="resourceupload" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Resources</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/') }}/course-task/file/data" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="file" name="files[]" id="file" multiple
                                        required />
                                    <div class="box">
                                        <div class="input-group mb-3 py-3" style="width:100%">
                                            <button type="submit" class="btn btn-success">Upload Files</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        {{-- {{print_r($Discussion)}} --}}

        <section>
            <div class="container my-1 py-2">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-lg-10 col-xl-8">
                        @foreach ($Discussion[0] as $item)
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-start align-items-center">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                            src="/storage/{{ explode('/', $item->dp, 2)[1] }}" alt="avatar"
                                            width="60" height="60" />
                                        <div>
                                            <h6 class="fw-bold text-primary mb-1">{{ $item->fname }}
                                                {{ $item->lname }} </h6>
                                            <p class="text-muted small mb-0">
                                                Shared on {{ $item->date }}

                                            </p>

                                        </div>
                                    </div>

                                    <p class="mt-3 mb-4 pb-2">
                                        {{ $item->post }}
                                    </p>


                                </div>

                            </div>
                        @endforeach
                        @if (count($Discussion[0]) == 0)
                            <div style="min-height:70vh;align-items:center">
                                <h1 style="margin-top:30%;color:orange">No announcement has been declared</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
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
