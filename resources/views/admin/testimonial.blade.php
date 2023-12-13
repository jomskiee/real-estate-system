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
                    <h1 class="m-0">Testimonial Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Testimonial Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <div class="container-fluid mt-5 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Total Testimonial Publish: {{ $count}}</h6>
                        </div>
                        <div class="card-body">


                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>User</th>
                                        <th>Testimonial</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($test as $key =>$item)
                                            <tr>
                                                <td>{{ $key + 1}}</td>
                                                <td>{{ $item->users->fname}} {{$item->users->lname}}</td>
                                                <td>
                                                    {!! $item->testimonial!!}
                                                </td>
                                                <td>
                                                    {{date('F d, Y', strtotime($item->created_at)) }}
                                                </td>
                                                <td class="d-flex justify-content-between">
                                                    <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                                                    <input data-id="{{$item->user_id}}" onchange="publishProp(this);" id ="checkbox" type="checkbox"
                                                        name="publish" data-toggle="switchbutton" data-size="sm"  data-onlabel="Published"
                                                        data-offlabel="Unpublish" value="{{$item->publish}} "{{ $item->publish == 1 ? 'checked' : '0' }}>
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

function publishProp(publish){
        var apply = $(publish).is(':checked') ? 1 : 0;
        var id = $(publish).data('id');

        $.ajax({
            type: "POST",
            url: "/dashboard/testimonial/publish/" + id,
            dataType: 'json',
            data: {
                    "publish": apply,
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
