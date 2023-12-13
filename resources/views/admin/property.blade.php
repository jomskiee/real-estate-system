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
                    <h1 class="m-0">Property Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Property Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        @include('inc.notif')
        @include('inc.addPropType')
        <div class="d-flex justify-content-end mt-5 mb-4 ">
            <button type="button" data-toggle="modal" data-target="#addPropType" class="btn btn-outline-success mx-4">Add Property Type</button>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if (count($properties) > 0)
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Thumbnail</th>
                                            <th>Project Name</th>
                                            <th>Price</th>
                                            <th>Property Type</th>
                                            <th>Location</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($properties as $key=> $property)
                                        <tr>
                                            <td>
                                                {{$key + 1  }}
                                            </td>
                                            <td>
                                                {{$property->fname}}
                                            </td>
                                            <td>
                                                {{$property->lname}}
                                            </td>
                                            <td> @foreach ($images as $image)
                                                    @if ($image->property_id == $property->id)
                                                        <img width="80px" height="60px"class="img-fluid shadow rounded-lg"
                                                        src="{{ asset('property/'.$property->user_id.'/'. $property->id .'/'.$image->property_images)}}" >
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$property->proj_name }}</td>
                                            <td>&#8369; {{ number_format($property->price) }} </td>
                                            <td>{{ $property->prop_type}}</td>
                                            <td>{{  $property->prop_location }}</td>
                                            <td>{{date('F d, Y', strtotime($property->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('viewProp', $property->slug) }}" target="_blank" class="btn btn-outline-primary">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>

                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            @else
                                <h6>No properties found!</h6>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<script>
    function statusProp(status){
        var apply = $(status).is(':checked') ? 1 : 0;
        var id = $(status).data('id');
        $.ajax({
            type: "POST",
            url: "/dashboard/all-properties/status/" + id,
            dataType: 'json',
            data: {
                    "status": apply,
                    "_token": $("#csrf_token").val()
                },
            success: function(data){
                alert(data['message']);
            }
        });
    };


$(function () {
    $('#example2').DataTable({
      "paging": true,
      "iDisplayLength": 10,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
});

</script>
@endsection
