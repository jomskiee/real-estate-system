@extends('layouts.dashboard')
@section('style')
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<link rel="stylesheet" href="{{ url('/')}}/css/swiper.css"/>
<style>

</style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('all-properties.index') }}">Property Management</a></li>
                        <li class="breadcrumb-item active">Property Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        <section class="content">
            <div class="container mb-5 display-flex justify-content-center">
                <div class="clearfix" >
                    <!-- Swiper -->
                    <div class="swiper-container two">
                        <div class="swiper-wrapper">
                            @foreach($propImage as $key => $image)
                            <div class="swiper-slide">
                                <div class="slider-image">
                                    <img  src="{{ asset('property/'.$property->user_id.'/'
                                    . $property->id .'/'.$image->property_images)}}" class="d-block w-100"  alt="...">
                                </div>
                            </div>
                            @endforeach
                        </div>
                         <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>


                    <div class="card  card-body bg-white my-4" >
                        <div class="row ">
                            <div class="col-sm-12 mb-3">
                                <h5 class="info-text text-center py-3"> LISTING INFORMATION</h5>
                            </div>
                            <div class="col-sm-6">
                                <h5><strong>Agent Information:</strong></h5>
                                <p class="mb-0 mx-2">Listing Agent: &nbsp;{{ $property->users->fname }} {{ $property->users->lname }} </p>
                                <p class="mb-0 mx-2">Mobile Number: &nbsp;{{ $property->users->mobile }}</p>
                                <p class="mb-0 mx-2">Email: &nbsp;{{ $property->users->email }}</p>

                            </div>
                            <div class="col-sm-6">
                                <h5><strong> Location:</strong></h5>
                                <p class="mb-0 mx-2">Province:  &nbsp;{{  ucwords(strtolower($location->province)) }}</p>
                                <p class="mb-0 mx-2">Municipality/City:  &nbsp;{{ ucwords(strtolower($location->city)) }}</p>
                                <p class="mb-0 mx-2">Barangay:  &nbsp;{{ $location->barangay }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card  card-body bg-white my-4" >
                        <div class="row ">
                            <div class="col-sm-12 mb-3">
                                <h5 class="info-text text-center py-3"> PROPERTY DETAILS</h5>
                            </div>
                            <div class="col-sm-6">
                                <h5><strong> Property Information:</strong></h5>
                                <p class="mb-0 mx-2">Project Name: &nbsp;{{$property->proj_name}}</p>
                                <p class="mb-0 mx-2">Property Type: &nbsp;
                                    @if ($propDetails->property_type == 1)
                                        House and Lot
                                @elseif ($propDetails->property_type == 2)
                                        Townhouse
                                    @else
                                        Villa
                                @endif </p>
                                <p class="mb-0 mx-2">Property Price: &nbsp; &#8369;{{ number_format($propDetails->price) }}</p>
                                <p class="mb-0 mx-2">Lot Area: &nbsp;{{ number_format($propDetails->lot_area)}}</p>
                                <p class="mb-0 mx-2">Floor Area: &nbsp;{{ number_format($propDetails->floor_area) }}</p>
                            </div>
                            <div class="col-sm-6">
                                <h5><strong> Structure Information:</strong></h5>
                                <p class="mb-0 mx-2">Bedroom: &nbsp;{{$propDetails->bedroom }}</p>
                                <p class="mb-0 mx-2">Bathroom: &nbsp;{{$propDetails->bathroom }}</p>
                                <p class="mb-0 mx-2">Story: &nbsp;{{$propDetails->story}}</p>
                                <p class="mb-0 mx-2">Furnish: &nbsp;{{$propDetails->furnished }}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <h5><strong> Facilities:</strong></h5>
                                <p class="mb-0 mx-2"><strong> {{ implode(' / ', $property->facilities()->get()->pluck('name')->toArray()) }}</strong></p>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h5><strong> Description:</strong></h5>
                                <p class="mb-0 mx-5">{!! $propDetails->desc !!} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script>

var swiper = new Swiper( '.swiper-container.two', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		effect: 'coverflow',
		loop: true,
		centeredSlides: true,
		slidesPerView: 'auto',
		coverflow: {
			rotate: 0,
			stretch: 100,
			depth: 150,
			modifier: 1.5,
			slideShadows : false,
		}
} );

</script>
@endsection
