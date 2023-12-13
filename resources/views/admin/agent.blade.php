@extends('layouts.dashboard')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Agent Clients</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('agencies')}}">Clients</a></li>
                            <li class="breadcrumb-item active">Agents</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Listed Clients:</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>User</th>
                                      <th>Email</th>
                                      <th>Agency Type</th>
                                      <th>Agency Company</th>
                                      <th>Agency Address</th>
                                      <th>Office Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agencies as $agency)
                                        <tr>
                                            <td>{{ $agency->fname }} {{ $agency->lname}} </td>
                                            <td>{{ $agency->email }}</td>
                                            <td>{{ $agency->role_type }}</td>
                                            <td>{{ $agency->agency_name}}</td>
                                            <td>{{ $agency->agency_address}}</td>
                                            <td>{{ $agency->office_no}}</td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                                </div>
                                <!-- /.card-body -->
                              </div>
                        </div>
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')
<script>
$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});
</script>
@endsection
