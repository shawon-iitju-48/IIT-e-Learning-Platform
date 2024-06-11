@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="profile" style="padding-left:20rem; padding-right:10rem;min-height:92vh">
        <h3>Searching</h3>
        <hr class="new5">
        {{-- <form action="{{ url('/') }}/searchteacher" method="post" enctype="multipart/form-data">
            @csrf --}}
        <div class="mb-3">
            <label for="" class="form-label">
                <h5 style="font-weight:bold">Searching Category:</h5>
            </label>
            <div style="display:flex;">
                <div class="form-check" style="margin-right:2rem;">
                    <input class="form-check-input" type="checkbox" value="okk" id="name">
                    <label class="form-check-label" for="flexCheckDefault">
                        Name
                    </label>
                </div>
                <div class="form-check" style="margin-right:2rem;">
                    <input class="form-check-input" type="checkbox" value="" id="designition">
                    <label class="form-check-label" for="flexCheckDefault">
                        Designition
                    </label>
                </div>
                <div class="form-check" style="margin-right:2rem;">
                    <input class="form-check-input" type="checkbox" value="" id="rinterest">
                    <label class="form-check-label" for="flexCheckDefault">
                        Research Interest
                    </label>
                </div>
            </div>
        </div>
        <div style="display:flex;">

            <div id="name1" class="mb-3 hidee" style="width:30%;margin-right:2rem;">
                <label for="" class="form-label">Enter Name:</label>
                <input id="name2" type="text" class="form-control" name="name" autocomplete="off">
            </div>
            <div id="designition1" class="mb-3 hidee" style="width:30%;margin-right:2rem;">
                <label for="" class="form-label">Enter Designition:</label>
                <input id="designition2" type="text" class="form-control" name="designition" autocomplete="off">
            </div>
            <div id="rinterest1" class="mb-3 hidee" style="width:30%;margin-right:2rem;">
                <label for="" class="form-label">Enter Research Interest:</label>
                <input id="rinterest2" type="text" class="form-control" name="rinterest" autocomplete="off">
            </div>
        </div>

        <div class="card">
            <button id="search" class="btn btn-primary" style="width:100%;background:#1E2772;">Search Any Teacher</button>
        </div>
        <div id="con">


        </div>
        {{-- </form> --}}
    </div>
    <script>
        $(document).ready(function() {

            $("#name").change(function() {
                if (this.checked) {
                    $("#name1").addClass("showw");
                    $("#name1").removeClass("hidee");
                } else {
                    $("#name1").addClass("hidee");
                    $("#name1").removeClass("showw");
                }
            });
            $("#designition").change(function() {
                if (this.checked) {
                    $("#designition1").addClass("showw");
                    $("#designition1").removeClass("hidee");
                } else {
                    $("#designition1").addClass("hidee");
                    $("#designition1").removeClass("showw");
                }
            });
            $("#rinterest").change(function() {
                if (this.checked) {
                    $("#rinterest1").addClass("showw");
                    $("#rinterest1").removeClass("hidee");
                } else {
                    $("#rinterest1").addClass("hidee");
                    $("#rinterest1").removeClass("showw");
                }
            });
            $("#search").click(function() {
                var des = $("#designition2").val();
                var name = $("#name2").val();
                var rin = $("#rinterest2").val();
                if (des == "")
                    des = "11";
                if (name == "")
                    name = "11";
                if (rin == "")
                    rin = "11";

                $.ajax({
                    url: "searchteacher/data",
                    method: "POST",
                    data: {
                        name: name,
                        designition: des,
                        rinterest: rin,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
                    success: function(data) {
                        var code = "";
                        code += '<table class="table table-striped">';
                        code += '<tbody>';
                        for (var i = 0; i < data.length; i++) {

                            let path = data[i]['dp'].slice(7, data[i]['dp'].length)
                            console.log(data[i]['email']);
                            code += '<tr>';
                            code += '<td>';
                            code += '<span class="user-img">';
                            code +=
                                '<img class="rounded-circle" src="/storage/' + path +
                                '" width="31"alt="aa">';
                            code += '<div class="user-text">';
                            code += '<h6>' + data[i]['fname'] + ' ' + data[i]['lname'] +
                            '</h6>';
                            code +=
                                '<p style="color:orange" class=" mb-0">' + data[i][
                                    'designition'] + '</p>';
                            code +=
                                '<p class="text-muted mb-0">Phone: ' + data[i]['phone'] +
                                '</p>';
                            code +=
                                '<p class="text-muted mb-0">Email: ' + data[i]['email'] +
                                '</p>';
                            code += '</span>';
                            code += '</td>';
                            code += '</tr>';
                        }

                        code += '</tbody>';
                        code += '</table>';
                        $("#con").html(code);
                    }
                });
            });


        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection
