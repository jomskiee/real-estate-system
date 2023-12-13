@extends('layouts.navbar')



@section('content')
<section class="d-flex align-items-center" style="background-color: #21243D;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white">{{ $rep->properties->proj_name }}</h2>
            </div>
            <p class="mt-0 text-white text-center"> Posted on: {{date('F d, Y', strtotime($rep->created_at)) }}</p>
        </div>
    </div>
</section>
<div class="carousel-properties owl-carousel">
    @foreach ($propImages as $image)
        <div class="thumbnail">
                <img style="height:50vh !important; object-fit: cover"class="img-fluid"
                src="{{ asset('property/'. Auth::user()->id.'/'. $image->property_id .'/'.$image->property_images)}}" />

        </div>
    @endforeach
</div>
<section class="ftco-section contact-section">
    <div class="container">
      <div class="row block-9 justify-content-center mb-5">
        <div class="col-md-8 mb-md-5">


            <div class="form-group">
                <label for="subject">Report Abuse Description</label>
              {{-- <textarea name="desc" id="" cols="30" rows="7" class="form-control"disabled> --}}
                  <div class="card card-body">
                        <p><strong>{{$rep->subject}}:</strong> {{ $rep->desc }}</p>
                  </div>

            </div>
        </div>
      </div>
    </div>
  </section>

@endsection
