@extends('layouts.dashboard')
@section('style')

    <!--croppie-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

    <style>
        #profImage{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/my-dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->
        @include('inc.notif')
        <div class="card mt-3 mb-5">
            <div class="card-header p-2 bg-light">
                <ul class="nav nav-pills " id="myTab">
                <li class="nav-item"><a class="nav-link active" href="#personalInfo" data-toggle="tab">Personal Info</a></li>
                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body bg-light">
                <div class="tab-content">
                    <div class="active tab-pane" id="personalInfo">

                            <div class="form-group row">
                                <label for="fname" class="col-sm-2 col-form-label" >Profile</label>
                                <label for="upload"  class="d-flex  justify-content-center">

                                    <img id="profImage" class="profile-user-img img-fluid" style="cursor:pointer; border:none !important;"
                                        src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt="User profile picture">
                                    <input type="file" name="avatar" id="upload" accept="image/*" style="display:none">

                                </label>
                                <div id="upload-img" class="col-md-4 col-sm-6 col-xs-6 ">
                                    <span id="deleteCrop" class="btn btn-danger  mt-2" >&times;</span>
                                    <div id="upload-image"></div>
                                    <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                                    <input id="submitAv" type='submit' class='btn btn-primary' value='Submit' />

                                </div>
                            </div>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="form-group row">
                                <label for="fname" class="col-sm-2 col-form-label" >First Name</label>
                                <div class="col-sm-10">
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ Auth::user()->fname }}">
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-2 col-form-label" >Last Name</label>
                                <div class="col-sm-10">
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ Auth::user()->lname }}" >
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label" >{{ __('E-Mail Address') }}</label>
                                <div class="col-sm-10">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2 col-form-label" >Mobile Number</label>
                                <div class="col-sm-10">
                                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ Auth::user()->mobile }}" >
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="province" class="col-sm-2 col-form-label" >Province</label>
                                <div class="col-sm-10">
                                    <input id="province" type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ Auth::user()->province }}" >
                                    @error('province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-sm-2 col-form-label" >Municipality / City</label>
                                <div class="col-sm-10">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ Auth::user()->city }}" >
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="barangay" class="col-sm-2 col-form-label" >Barangay</label>
                                <div class="col-sm-10">
                                    <input id="barangay" type="text" class="form-control @error('barangay') is-invalid @enderror" name="barangay" value="{{ Auth::user()->barangay }}" >
                                    @error('barangay')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="password">
                        <form class="form-horizontal" action="{{ route('password') }}" method="POST" id="password_form">
                            <div class="form-group row">
                                @csrf
                                <label for="password" class="col-sm-2 col-form-label" >Old Password</label>
                                <div class="col-sm-10">
                                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" >
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label" >New Password</label>
                                <div class="col-sm-10">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-sm-2 col-form-label" >{{ __('Confirm Password') }}</label>
                                <div class="col-sm-10">
                                    <input id="confirm_password" type="password" class=" form-control" name="confirm_password" >
                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>


<script type="text/javascript">

    $(document).ready(function(){
        $('#upload-img').addClass('collapse');
        $('#upload-img').collapse('hide');
            $uploadCrop = $('#upload-image').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 250,
                height: 250
            }

        });


        $("#deleteCrop").on('click', function() {
            // $('#upload-image').croppie('destroy');
            $('#upload-img').collapse('hide');
        });

        $('#upload').on('change', function() {

            var reader = new FileReader();
                reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#upload-img').collapse('show');  //this will show the upload crop js
        });

        $('#submitAv').on('click', function (ev) {
            $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
            }).then(function (img) {
                // console.log(img);
                $.ajax({
                    url: "{{ route('crop') }}",
                    type: "POST",
                    data: {
                        "avatar":img,
                        "_token": $("#csrf_token").val()
                    },
                    success: function (data) {

                        $("#profImage").attr('src', data);
                        // console.log(data);
                        $('#upload-img').collapse('hide');
                        // console.log(data);
                    }
                });
            });
        });

    });

    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>

