@extends('layouts.navbar')
@section('content')

<section class="d-flex align-items-center" style="background-color: #21243D;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white">My Personal Account</h2>
            </div>
        </div>
    </div>
</section>

  <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            @include('inc.notif')
            <h3 class="text-center mt-5 ">Account Information</h3>
            <div class="row">
                <div class="col-md-12 pills">
                    <div class="bd-example bd-example-tabs">
                        <div class="d-flex">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Password</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">

                                <div class="row d-flex justify-content-center">
                                        <div class="col-lg-4 col-md-4 col-sm-6 ">
                                            <label for="upload"  class="d-flex  justify-content-center">

                                                <img id="profImage" class="col-lg-8 img-fluid " style="cursor:pointer;"
                                                    src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt="User profile picture">
                                                <input type="file" name="avatar" id="upload" accept="image/*" style="display:none">
                                            </label>
                                            <div id="upload-img" class="col-md-4 col-sm-6 col-xs-6">
                                                <span id="deleteCrop" class="btn btn-danger  mt-2" >&times;</span>
                                                <div id="upload-image"></div>
                                                <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                                                <input id="submitAv" type='submit' class='btn btn-primary' value='Submit' />

                                            </div>
                                        </div>


                                </div>

                                <form action="{{ route('myprofile.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
                                    {{ method_field('PUT') }}
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name <small></small></label>
                                                <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{ $user->fname }}">
                                                @error('firstname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name <small></small></label>
                                                <input name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" value="{{ $user->lname }}">
                                                @error('lastname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Email <small></small></label>
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                                                @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Phone :</label>
                                                <input id="phone" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" value="{{ $user->mobile }}">
                                                @error('mobile')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Province <small></small></label>
                                                <input name="province" type="text" class="form-control @error('province') is-invalid @enderror" value="{{ $user->province }}">
                                                @error('province')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>City/Municipality <small></small></label>
                                                <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" value="{{ $user->city }}">
                                                @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Barangay <small></small></label>
                                                <input name="barangay" type="text" class="form-control @error('barangay') is-invalid @enderror" value="{{ $user->barangay }}">
                                                @error('barangay')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label for="agency">Client Type</label>
                                                <select class="form-control" id="client" name="role_id">
                                                    @foreach ($roles as $item)
                                                        <option value="{{ $item->id }}" id="role-{{$item->id}}"
                                                            @if($user->role_id == $item->id) selected="selected" @endif>
                                                            {{ $item->role_type }}
                                                        </option>
                                                    @endforeach

                                                    {{-- <option value="2">Agent</option> --}}
                                                </select>
                                            </div>
                                            <div class="form-group agency_hide agency_3 ">
                                                <label for="agency_name">Agency Name</label>
                                                <input id="agency_name" type="text" class="form-control @error('agency') is-invalid @enderror" name="agency_name" value="{{$client->agency_name}}">

                                                @error('agency')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group agency_hide agency_3 ">
                                                <label for="angency_address">Address</label>
                                                <input id="agency_address" type="text" class="form-control  @error('agency_address') is-invalid @enderror" name="agency_address" value="{{$client->agency_address}}">

                                                @error('agency_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group agency_hide agency_3 ">
                                                <label for="office">Office Number </label>
                                                <input id="office_no" type="tel" class="form-control  @error('office_no') is-invalid @enderror" name="office_no" value="{{$client->office_no}}">

                                                @error('office_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2 ">
                                            <div class="form-group">
                                                <h5 class="mb-0 text-center mt-2"><strong>TESTIMONIAL </strong></h5>
                                                {{-- <p class="text-danger" style="font-size: 15px;">(Maximum of 200 characters)</p> --}}
                                                <textarea id="testimonial"rows="5" maxlength="200"name="testimonial" class="mt-3 form-control
                                                @error('testimonial') is-invalid @enderror">@if ($test){!!$test->testimonial!!}@endif</textarea>
                                                @error('testimonial')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div id="charNum" class="float-right">
                                                <p><span id="countNo">0</span> / 200</p>
                                                <p class="error-msg" class="invalid-feedback text-red">Character Limit Exceed</p>
                                            </div>
                                        </div>


                                        <div class="col-sm-3 offset-sm-9">
                                            <div class="form-group text-right mt-2">
                                                <input type='submit' class='btn btn-primary' value='Submit' />
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>


                                    </div>
                                </form>

                            </div>

                            <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
                                <h4 class="info-text">Change Password</h4>
                                <form action="{{ route('password') }}" method="POST" id="password_form">
                                    @csrf
                                    <div class="row p-b-15">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Old Password:</label>
                                                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" >
                                                    @error('old_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong >{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>New Password :</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Confirm Password :</label>
                                                    <input id="confirm_password" type="password" class=" form-control" name="confirm_password" >
                                                    @error('confirm_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 offset-sm-9">
                                            <div class="form-group text-right mt-2">
                                                <input type='submit' class='btn  btn-primary' value='Submit' />
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
<script>
    // $(function(){
    //     $('#count').keyup(function(event){
    //         $('#countNo').text($(this).val().length);
    //         var x = $(this).val().length;
    //         if(x > 200){
    //             $(this).css("border", '1px solid red');
    //             $(".error-msg").show();
    //         }
    //         else{
    //             $(".error-msg").hide();
    //             $(this).css("border", '');
    //         }
    //     })
    // })

    //add a collapse class
    $('#upload-img').addClass('collapse');
    //hide this div first
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
    $("#deleteCrop").on('click', function() {
        // $('#upload-image').croppie('destroy');
        $('#upload-img').collapse('hide');
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

    //add collapse to all tags hiden and showed by select mystuff
    $('.agency_hide').addClass('collapse');

    //on change hide all divs linked to select and show only linked to selected option
    var x =  $('select option[value=3]').is(':selected');
    if(x){
        $('.agency_hide').collapse('show');
    }else{
        $('.agency_hide').collapse('hide');
    }

    $('#client').change(function(){
        //Saves in a variable the wanted div
        var selector = '.agency_' + $(this).val();
        //hide all elements
        $('.agency_hide').collapse('hide');

        //show only element connected to selected option
        $(selector).collapse('show');

    });


    $(document).ready(function() {
        $("#summerNote").summernote({
            height: 150,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ],
            callback:[

            ],
        });
    });
    $(".error-msg").hide();
    $('#testimonial').keyup( function(e) {
        $('#countNo').text($(this).val().length);
        var x = $(this).val().length;
        if(x > 200){
            $(".error-msg").show();
        }
        else{
            $(".error-msg").hide();
        }
    });


    $(document).ready(function(){
        $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#pills-tab a[href="' + activeTab + '"]').tab('show');
        }
    });

</script>
@endsection
