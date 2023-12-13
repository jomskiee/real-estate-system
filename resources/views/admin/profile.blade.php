@extends('layouts.dashboard')
@section('content')
    {{-- modal for delete --}}
    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this account ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/users')}}">User Management</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->
        @include('inc.notif')

        <div class="row justify-content-center">
            <div class="col-md-9 card">
                <!-- Profile Image -->
                <div class="row">
                    <div class="col-md-4 border-right">
                        <div class="text-center my-3">
                            <img src="{{ asset('avatars/'.$user->avatar) }}" alt="user-avatar" class="img-fluid col-sm-6">
                            <input type="file"  id="file" name="avatar" style="display: none;">
                        </div>
                        <h3 class="profile-username text-center mb-0"><strong>{{ $user->fname }}  {{ $user->lname }}</strong></h3>
                            <h6 class="text-center mt-3 mb-0 "><b>{{ $user->role_type }}</b></h6>

                        <p class="text-muted text-center">{{ $user->email }}</p>
                        <ul class="list-group list-group-unbordered my-5 mx-3">
                            @if($user->role_type == 'Agent' || $user->role_type == 'Private')
                            <li class="list-group-item">
                                <b>Properties</b> <a id="property-{{$user->id}}"class="float-right" href="" target="_blank">{{ $prop }}</a>
                            </li>

                            <script>
                                var newurl = window.location.protocol + "//" + window.location.host + '/dashboard/all-properties?uid={{ $user->id }}';
                                $('#property-{{ $user->id }}').attr("href", newurl);
                            </script>
                            <li class="list-group-item">
                            <b>Favourites</b> <a class="float-right text-reset text-decoration-none">{{ $fav }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-7 mx-3 mb-4">
                        <h4 class="my-3 text-muted text-center"><b>Personal Information</b></h4>
                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right" >First Name:</label>
                            <div class="col-md-8">
                            <input id="fname" type="text" class="form-control" value="{{ $user->fname }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right" >Last Name:</label>
                            <div class="col-md-8">
                            <input id="lname" type="text" class="form-control" value="{{ $user->lname }}" readonly>
                            </div>
                        </div>

                        <h6 class="my-3 text-muted"><b>Contact Information</b></h6>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" >{{ __('E-Mail Address') }}:</label>
                            <div class="col-md-8">
                            <input id="email" type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right" >Mobile Number:</label>
                            <div class="col-md-8">
                            <input id="mobile" type="text" class="form-control" value="{{ $user->mobile }}" readonly>
                            </div>
                        </div>
                        <h6 class="my-3 text-muted"><b>Address Information</b></h6>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right" >Province:</label>
                            <div class="col-md-8">
                            <input id="province" type="text" class="form-control" value="{{ $user->province }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right" >City/Municipality:</label>
                            <div class="col-md-8">
                            <input id="city" type="text" class="form-control" value="{{ $user->city }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right" >Barangay:</label>
                            <div class="col-md-8">
                            <input id="barangay" type="text" class="form-control " value="{{ $user->barangay }}" readonly>
                            </div>
                        </div>
                        @if($user->role_type == 'Agent' || $user->role_type == 'Private')
                            <h4 class="my-4 text-muted text-center"><b>Client Information</b></h4>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right" >Client Type:</label>
                                <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $user->role_type}}"
                                readonly>
                                </div>
                            </div>
                            @if ($user->role_type == 'Agent')
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right" >Agency Name:</label>
                                <div class="col-md-8">
                                <input id="city" type="text" class="form-control" value="{{ $agency->agency_name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right" >Office Number:</label>
                                <div class="col-md-8">
                                <input id="barangay" type="text" class="form-control" value="{{ $agency->office_no }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right" >Address:</label>
                                <div class="col-md-8">
                                <input id="barangay" type="text" class="form-control" value="{{ $agency->agency_address }}" readonly>
                                </div>
                            </div>
                            @endif

                        @endif

                    </div>
                </div>
            </div>
            </div>
        <!-- /.card-body -->
        </div>

@endsection

