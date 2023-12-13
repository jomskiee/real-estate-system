@extends('layouts.navbar')
@section('content')
@include('inc.notif')

<section class="d-flex align-items-center" style="background-color: #21243D;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white">Reported Property</h2>
            </div>
        </div>
    </div>
</section>
<div class="content-area blog-page padding-top-40" style="background-color: #FCFCFC; padding-bottom: 55px;">
    <div class="container">
        <div class="row">
            <div class="blog-lst col-md-12 pl0">
                <section id="id-100" class="post single">


                    <div id="post-content" class="post-body single wow fadeInLeft animated mt-5">
                      <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Property Name</th>
                                    <th>Property Type</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if(count($props) > 0) --}}
                                    @foreach ($reports as $prop)
                                    <tr>
                                        <td>@foreach ($images as $image)
                                                @if ($image->property_id == $prop->property_id)
                                                    <img style="height: 90px !important; width: 100px !important;"class="img-fluid shadow rounded-lg"
                                                    src="{{ asset('property/'.Auth::user()->id.'/'. $prop->property_id .'/'.$image->property_images)}}" >
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ Str::limit($prop->properties->proj_name , 20)}}</td>
                                        <td>{{ $prop->properties->prop_type->prop_type }}</td>
                                        <td>{{ $prop->subject }}</td>
                                        <td>{{ $prop->desc }}</td>
                                        <td>{{ date('F d, Y', strtotime($prop->created_at )) }}</td>
                                        <td class="d-flex"><a href="{{ route('repProp', $prop->property_id) }}">
                                            <button type="button" class="btn btn-success btn-sm">View</button>
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach

                                {{-- @endif --}}
                            </tbody>
                    </table>
                      </div>
                    </div>
                </section>


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
