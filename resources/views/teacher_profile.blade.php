@extends('layout.master')
<script>
    window.onload = function() {
        document.getElementById("profile").classList.add("active");
    }
</script>

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="profile">
        <h3>Your Profile</h3>
        <hr class="new5">
        <form action="{{ url('/') }}/profile/tdata" method="post" enctype="multipart/form-data">
            @csrf
            <div class="profilecard">
                <div class="name">
                    Your e-mail
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1">Email</span> --}}
                        <input name="email" type="text" class="form-control" value="{{ $Profileinfo[0]->email }}"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    <span>

                </div>
            </div>
            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Your photo
                </div>
                <div class="box">
                    <img src="/storage/{{ explode('/', $Profileinfo[0]->dp, 2)[1] }}" alt="">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1"></span> --}}
                        <input name="dp" class="form-control" type="file" id="formFile">
                    </div>
                    
                </div>
            </div>
            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Your name
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1"></span> --}}
                        <input name="fname" type="text" class="form-control" value="{{ $Profileinfo[0]->fname }}"
                            aria-label="Username" aria-describedby="basic-addon1">
                        <input name="lname" style="margin-left:5%;" type="text" class="form-control"
                            value="{{ $Profileinfo[0]->lname }}" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>

            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Update your password
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1">Email</span> --}}
                        <input name="password" type="password" class="form-control" 
                            placeholder="Update your password" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                </div>
            </div>
            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Update your phone no.
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1">Email</span> --}}
                        <input name="phone" type="text" class="form-control" value="{{ $Profileinfo[0]->phone }}"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                </div>
            </div>
            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Research Interest
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1">Email</span> --}}
                        <input name="rinterest" type="text" class="form-control" value="{{ $Profileinfo[0]->rinterest }}"
                            placeholder="Update your research interest [comma seperated]" aria-label="Username"
                            aria-describedby="basic-addon1">
                    </div>

                </div>
            </div>
            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Blood Group
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        <select name="bg" class="form-select" aria-label="Default select example">
                            <option  selected>Select Your Blood Group</option>
                            <option value="A+">A RhD positive (A+)</option>
                            <option value="A-">A RhD negative (A-)</option>
                            <option value="B+">B RhD positive (B+)</option>
                            <option value="B-">B RhD negative (B-)</option>
                            <option value="O+">O RhD positive (O+)</option>
                            <option value="O-">O RhD negative (O-)</option>
                            <option value="AB+">AB RhD positive (AB+)</option>
                            <option value="AB-">AB RhD negative (AB-)</option>
                        </select>
                    </div>

                </div>
            </div>
            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Gender
                </div>
                <div class="box">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1"
                            value="Male">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2"
                            Value="Female">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Female
                        </label>
                    </div>

                </div>
            </div>
            <hr class="new1">
            <div class="profilecard">
                <div class="name">
                    Designition
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1">Email</span> --}}
                        <input name="designition" type="text" class="form-control" value="{{ $Profileinfo[0]->designition }}"
                            placeholder="Update your designition" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                </div>
            </div>

           

            <div class="profilecard" style="margin-top:2rem;margin-bottom:2rem;">
                <div class="name">
                    Update your personal details
                </div>
                <div class="box">
                    <div class="input-group mb-3">
                        {{-- <span class="input-group-text" id="basic-addon1">Email</span> --}}
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
