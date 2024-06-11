@extends('layout.adminlay')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="profile" style="min-height:92vh">
        <h3>Add Batch Information</h3>
        <div style="display:flex;margin-top:1rem">
            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" style="margin-right:1.5rem;"><i
                    class="fa fa-plus"></i> New Student</a>
            <a href="#excel" data-toggle="modal" class="btn btn-success btn-sm btn-flat" style="margin-right:1.5rem;"><i
                    class="fa fa-plus"></i> Import Excel</a>

        </div>
        <div style="margin-top:1rem;margin-bottom:1rem;display:flex">
            <input name="skey" id="skey" style="width:40%;margin-right:2rem;" class="form-control" type="text"
                placeholder="Search By Batch">
            <button class="btn btn-primary" id="search" style="width:10%">Search</button>
        </div>

        <div class="modal fade" id="addnew">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/') }}/iitadmin/update/data"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="id" class="col-sm-3 control-label">Student ID</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="uid" name="uid" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="batch" class="col-sm-3 control-label">Batch</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="batch" name="batch" required>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i>
                            Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="excel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/') }}/iitadmin/excel/data" enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="form-control" name="excel" required value="">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-flat" name="import"><i class="fa fa-save"></i>
                            Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Batch</th>
                </tr>
            </thead>
            <tbody id="con">
                @foreach ($Info as $item)
                    <tr>
                        <td>{{ $item->u_id }}</td>
                        <td>{{ $item->batch }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>


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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#search").click(function() {
                var s = $('#skey').val();

                $.ajax({
                    url: "iitadmin/search/data",
                    method: "POST",
                    data: {
                        batch: s,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        let code = "";
                        for (var i = 0; i < data.length; i++) {
                            code += ' <tr>';
                            code += '<td>';
                            code += data[i]['u_id'];
                            code += '</td>';
                            code += '<td>';
                            code += data[i]['batch'];
                            code += '</td>';

                            code += '</tr>';
                        }
                        $("#con").html(code);

                    }

                });
            });

        });
    </script>
@endsection
