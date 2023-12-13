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
                    <h1 class="m-0">Save Properties</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Save Properties</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <div class="container-fluid mt-5 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Property Name</th>
                                        <th>Bedroom</th>
                                        <th>Bathroom</th>
                                        <th>Location</th>
                                        <th>Property Type</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($props) > 0)
                                    @foreach ($props as $prop)
                                    <tr>
                                        <td>@foreach ($images as $image)
                                            @if ($image->property_id == $prop->id)
                                            <a href="{{ route('viewProp', $prop->slug) }}">
                                                <img style="height: 90px !important; width: 100px !important;"class="img-fluid shadow rounded-lg"
                                                src="{{ asset('property/'.$prop->user_id.'/'. $prop->id .'/'.$image->property_images)}}" >
                                            </a>
                                            @endif

                                        @endforeach </td>
                                        <td>{{ Str::limit($prop->proj_name , 20)}}</td>
                                        <td>{{$prop->bedroom }}</td>
                                        <td>{{$prop->bathroom }}</td>
                                        <td>{{Str::limit($prop->province, 5) }}, {{ Str::limit($prop->city, 1) }}, {{ Str::limit($prop->barangay, 1) }}</td>
                                        <td>{{$prop->property_type }}</td>
                                        <td>&#8369; {{number_format($prop->price) }} </td>
                                        <td class="mx-5"><a href="{{ route('viewProp', $prop->slug) }}"><button type="button" class="btn btn-success btn-sm">
                                                View
                                            </button></a>
                                            <a href="javascript:void(0);" onclick="document.getElementById('fav-form').submit();"><button type="button" class="btn btn-danger btn-sm">
                                                Remove
                                            </button></a>
                                            <form id="fav-form"action="{{ route('delFavAdmin',$prop->id)}}"
                                                method="POST" style="display: none;">
                                                {{ method_field('DELETE') }}
                                                @csrf
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach

                                @endif
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
<script>
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
