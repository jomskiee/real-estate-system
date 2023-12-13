@extends('layouts.dashboard')

@section('style')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Management</li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        <div class="card card-solid my-5 mx-2">
            <div class="card-header">
                <!-- Navbar Search -->
                <form action="{{ route('searchUser') }}" class="input-group form-container input-group-sm row">
                    @csrf
                    <div class="form-group col-md-9 d-flex">
                        <input name="search" class="form-control search-input" type="search" placeholder="Search User..."
                    aria-label="Search" autofocus="autofocus" autocomplete="off">

                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-3">
                        <select name="role_type" class="form-control" onchange="this.form.submit();">
                            <option value="" hidden>User Role</option>
                            @foreach ($roles as $item)
                            <option value="{{$item->id}}">{{$item->role_type}}</option>
                            @endforeach

                        </select>

                    </div>
                </form>

            </div>
            <div  class="card-body pb-0">
                <div id="card" class="row">
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column mb-3">
                            <div class="card bg-light d-flex flex-fill">
                                <div id="role" class="card-header text-muted border-bottom-0">
                                    <p class="mb-0 float-left">{{ $user->role_type }}</p>
                                    @if($user->role_type == 'Agent' || $user->role_type == 'Private')
                                        @php($count = 0)
                                        @foreach ($reports as $item)

                                            @if ($item->properties->users->id == $user->id)

                                                <a id="report-{{ $user->id }}" href="" target="_blank">
                                                    <p class="mb-0 float-right">Report
                                                        @php($count++)
                                                        <span class="badge badge-danger">  {{($count)}}</span>
                                                    </p>
                                                </a>

                                                <script>
                                                    var newurl = window.location.protocol + "//" + window.location.host + '/dashboard/reports/filter?uid={{ $user->id }}';
                                                    $('#report-{{ $user->id }}').attr("href", newurl);
                                                </script>

                                            @endif

                                        @endforeach

                                    @endif

                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead" id="name"><b>{{ $user->fname }} {{ $user->lname }}</b></h2>
                                        <p class="text-muted text-sm"></p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small mb-2" id="email">
                                                <span class="fa-li">
                                                    <i class="fas fa-envelope-open-text"></i>
                                                </span>
                                                Email: {{  Str::limit($user->email, 15) }}
                                            </li>
                                            <li class="small mb-2" id="province">
                                                <span class="fa-li">
                                                    <i class="fas fa-lg fa-building"></i>
                                                </span>
                                               Address: {{ Str::limit($user->province , 10) }} ,{{ Str::limit($user->city , 1) }},
                                                {{ Str::limit($user->barangay , 1) }}
                                            </li>
                                            <li class="small" id="">
                                                <span class="fa-li">
                                                    <i class="fas fa-lg fa-phone"></i>
                                                </span> Phone #: {{ Str::limit($user->mobile, 11)}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ asset('avatars/'.$user->avatar) }}" alt="user-avatar" class="img-fluid" >
                                    </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @if($user->role_type == 'Agent' || $user->role_type == 'Private')
                                        <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                                        <input class="float-left" data-id="{{ $user->id }}" onchange="activeUser(this);" id ="checkbox"
                                            type="checkbox" name="active" data-toggle="switchbutton" data-width="100"
                                            data-size="sm" data-onlabel="Active" data-offlabel="Inactive" value="{{$user->active}}"
                                            {{ $user->active == 1 ? 'checked' : '0' }}>
                                    @endif

                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary float-right">
                                        <i class="fas fa-user"></i> View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                         @endforeach
                    @else
                        <h6>No user found!</h6>
                    @endif

                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                    <ul class="pagination justify-content-center m-0">
                        {{ $users->links('pagination') }}
                    </ul>
                </nav>
            </div>
        </div>

    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<script >



    function activeUser(active){
        var apply = $(active).is(':checked') ? 1 : 0;
        var id = $(active).data('id');

        $.ajax({
            type: "POST",
            url: "/dashboard/users/active/" + id,
            dataType: 'json',
            data: {
                    "active": apply,
                    "_token": $("#csrf_token").val()
                },
            success: function(data){
                alert(data['message']);
            }
        });
    };
    // $(document).ready(function() {

    //     fetch_user();

    //     function fetch_user(query = ''){

    //         $.ajax({
    //             url: "/dashboard/users/search",
    //             dataType: 'json',
    //             method: 'GET',
    //             headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    //             data:{
    //                 query: query
    //             },

    //             success: function(data){
    //                //console.log(data);
    //                $('.pagination').show();
    //                 $('#card').html(data.card_data);

    //             }
    //         })
    //     }
    //     $(document).on('keyup', '#search', function(){
    //         var query = $(this).val();
    //         fetch_user(query);
    //     })
    // });

</script>

@endsection

