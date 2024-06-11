@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="profile" style="padding-left:20rem; padding-right:10rem;min-height:92vh">
        <h3>Searching</h3>
        <hr class="new5">
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
                    <input class="form-check-input" type="checkbox" value="" id="batch">
                    <label class="form-check-label" for="flexCheckDefault">
                        Batch
                    </label>
                </div>
                <div class="form-check" style="margin-right:2rem;">
                    <input class="form-check-input" type="checkbox" value="" id="skills">
                    <label class="form-check-label" for="flexCheckDefault">
                        Skills
                    </label>
                </div>
                <div class="form-check" style="margin-right:2rem;">
                    <input class="form-check-input" type="checkbox" value="" id="bg">
                    <label class="form-check-label" for="flexCheckDefault">
                        Blood Group
                    </label>
                </div>
            </div>
        </div>
        <div style="display:flex;">

            <div id="name1" class="mb-3 hidee" style="width:30%;margin-right:2rem;">
                <label for="" class="form-label">Enter Name:</label>
                <input id="name2" type="text" class="form-control" name="name" autocomplete="off">
            </div>
            <div id="batch1" class="mb-3 hidee" style="width:30%;margin-right:2rem;">
                <label for="" class="form-label">Enter Batch:</label>
                <input id="batch2" type="text" class="form-control" name="batch" autocomplete="off">
            </div>
            <div id="skills1" class="mb-3 hidee" style="width:30%;margin-right:2rem;">
                <label for="" class="form-label">Enter Skills:</label>
                <input id="skills2" type="text" class="form-control" name="skills" autocomplete="off">
            </div>
            <div id="bg1" class="mb-3 hidee" style="width:30%;margin-right:2rem;">
                <label for="" class="form-label">Enter Blood Group:</label>
                <input id="bg2" type="text" class="form-control" name="bg" autocomplete="off">
            </div>
        </div>

        <div class="card">
            <button id="search" class="btn btn-primary" style="width:100%;background:#1E2772;">Search Any Student</button>
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
            $("#batch").change(function() {
                if (this.checked) {
                    $("#batch1").addClass("showw");
                    $("#batch1").removeClass("hidee");
                } else {
                    $("#batch1").addClass("hidee");
                    $("#batch1").removeClass("showw");
                }
            });
            $("#skills").change(function() {
                if (this.checked) {
                    $("#skills1").addClass("showw");
                    $("#skills1").removeClass("hidee");
                } else {
                    $("#skills1").addClass("hidee");
                    $("#skills1").removeClass("showw");
                }
            });
            $("#bg").change(function() {
                if (this.checked) {
                    $("#bg1").addClass("showw");
                    $("#bg1").removeClass("hidee");
                } else {
                    $("#bg1").addClass("hidee");
                    $("#bg1").removeClass("showw");
                }
            });
            $("#search").click(function() {
                var batch = $("#batch2").val();
                var name = $("#name2").val();
                var skills = $("#skills2").val();
                var bg = $("#bg2").val();
                if (batch == "")
                    batch= "ku";
                if (name == "")
                    name = "11";
                if (skills == "")
                    skills = "11";
                if (bg == "")
                    bg = "11";
                $.ajax({
                    url: "searchstudent/data",
                    method: "POST",
                    data: {
                        name: name,
                        batch: batch,
                        skills: skills,
                        bg:bg,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
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
                                '<p style="color:orange" class=" mb-0">Batch: ' + data[i][
                                    'batch'
                                ] + '</p>';
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
