@extends('layouts.sDashboard')

@section('style')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/my-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Agency</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid mt-5 mb-5">
                @include('inc.notif')
                <div class="card">
                    <div class="card-header bg-light">
                        <h2 class="text-start"><strong>Agency Information:</strong></h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="agency">Agency Type</label>
                                    <input type="text" class="form-control" value="{{$agency->agency_type == 0 ? 'Private Seller' : 'Agency Company'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="agency_name">Agency Name</label>
                                    <input  type="text" class="form-control"  value="{{ $agency->agency_name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="angency_address">Address</label>
                                    <input  type="text" class="form-control" value="{{ $agency->agency_address }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="office">Office Number </label>
                                    <input type="tel" class="form-control" value="{{ $agency->office_no }}" readonly>
                                </div>
                            </div>
                            <form action="{{ route('agency.update', $agency) }}" method="POST" class="col-md-6">
                                {{ method_field('PUT') }}
                                @csrf
                                <div class="form-group ">
                                    <label for="agency">Agency Type</label>
                                    <select class="form-control" id="agency" name="agency_type">
                                        <option value="0">Private Seller</option>
                                        <option value="1">Agency Company</option>
                                    </select>
                                </div>
                                <div class="form-group agency_hide agency_1 ">
                                    <label for="agency_name">Agency Name</label>
                                    <input id="agency_name" type="text" class="form-control @error('agency') is-invalid @enderror" name="agency_name">

                                    @error('agency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group agency_hide agency_1 ">
                                    <label for="angency_address">Address</label>
                                    <input id="agency_address" type="text" class="form-control" name="agency_address">

                                    @error('agency_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group agency_hide agency_1 ">
                                    <label for="office">Office Number </label>
                                    <input id="office_no" type="tel" class="form-control" name="office_no">

                                    @error('office_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <input type="submit" class="btn btn-outline-primary">
                                </div>
                            </form>

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
                    //add collapse to all tags hiden and showed by select mystuff
        $('.agency_hide').addClass('collapse');

        //on change hide all divs linked to select and show only linked to selected option
        $('#agency').change(function(){
            //Saves in a variable the wanted div
            var selector = '.agency_' + $(this).val();

            //hide all elements
            $('.agency_hide').collapse('hide');

            //show only element connected to selected option
            $(selector).collapse('show');

        });
    </script>
@endsection
