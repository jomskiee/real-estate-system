@extends('layouts.dashboard')
@section('style')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ url('/')}}/css/drop.css">
{{-- <link id="skin-default" rel="stylesheet" href="{{ url('/')}}/css/theme.css?ver=2.4.0"> --}}
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Report Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Report Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid mt-5 mb-4">
            @include('inc.notif')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Reported by:</th>
                                        <th>Posted by:</th>
                                        <th>Property Details</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rep as $key =>$report)
                                            <tr>
                                                <td>{{ $key + 1}}</td>
                                                <td>{{ $report->fname}} {{$report->lname}}</td>

                                                <td>
                                                    @foreach ($users as $user)
                                                       @if ($user->id == $report->client_id)
                                                           {{$user->fname}} {{$user->lname}}
                                                       @endif
                                                    @endforeach
                                                    {{-- @foreach ($reports as $item)
                                                        @if ($item->property_id == $report->property_id)
                                                            {{ $item->properties->users->fname}} {{ $item->properties->id}}
                                                        @endif

                                                    @endforeach --}}

                                                </td>

                                                <td><h6 class="text-center">{{ $report->proj_name}}</h6>
                                                    <p class="mb-0"><strong>Price:</strong>  &nbsp; &#8369; {{ number_format($report->price)}}</p>
                                                    <p class="mb-0"><strong>Property Type:</strong>  &nbsp;{{ $report->prop_type}}</p>
                                                </td>
                                                <td>
                                                    {{ $report->subject}}
                                                </td>
                                                <td>
                                                    {{$report->desc}}
                                                </td>
                                                <td>
                                                    {{date('F d, Y', strtotime($report->created_at)) }}
                                                </td>
                                                <td>
                                                    <a href="#"> <input  class="mx-auto" type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                                                        <input  data-id="{{$report->property_id}}" onchange="statusProp(this);" id ="checkbox" type="checkbox"
                                                        name="status" data-toggle="switchbutton" data-size="sm" data-onlabel="Active"
                                                        data-offlabel="Inactive" value="{{$report->status}} "{{ $report->status == 1 ? 'checked' : '0' }}>
                                                    </a>

                                                </td>
                                                <td>
                                                    <a href="{{ route('viewProp', $report->slug) }} " class="text-decoration-none" target="_blank">
                                                        <button type="button" class="btn btn-success btn-sm mx-auto">
                                                            <i class="fa fa-eye" aria-hidden="true"> </i>
                                                        </button>
                                                    </a>


                                                    {{-- <a href="javascript:void(0);" onclick="document.getElementById('rep-form-{{ $report->id }}').submit();"
                                                        class="text-decoration-none">
                                                        <button type="button" class="btn btn-danger btn-sm btn-block">
                                                            <i class="fa fa-trash" aria-hidden="true"> </i> Delete
                                                        </button>
                                                    </a> --}}
                                                    {{-- <form id="rep-form-{{ $report->id }}" action="{{ route('delReport',$report->id )}}" method="POST"  style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form> --}}


                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
