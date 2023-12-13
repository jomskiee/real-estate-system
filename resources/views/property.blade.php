@extends('layouts.navbar')


@section('content')

<section class="d-flex align-items-center" style="background-color: #21243D;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white">{{ $prop->proj_name}}</h2>

            </div>
            <p class="mt-0 text-white text-center"> Posted on: {{date('F d, Y', strtotime($prop->created_at)) }}</p>
        </div>
    </div>
</section>
  <section class="ftco-section ftco-property-details mt-2">
    @include('inc.report')
    @include('inc.notif')
    <div class="container">
        @if ($prop->publish == 0)
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Property is not available!</strong>
            </div>
        @endif

        <div class="row">
            <div class="col-md-3 order-md-2 mb-4">
                <div class="card card-body border d-flex justify-content-center">
                    <span class="text-center">Listing provided by:</span>
                    <img src="{{ asset('avatars/'.$prop->avatar) }}" class=" my-2 mx-auto" style="max-width: 70%; height:auto;">
                    <h6 class="mt-2 mb-0 text-center"><strong>{{ strtoupper($prop->fname) }} {{ strtoupper($prop->lname) }} </strong></h6>
                    <p class=" text-center"><strong>{{ $prop->users->roles->role_type}}</strong></p>
                    <div class="clearfix"></div>
                    <h6>Contact Information:</h6>
                    <li class="d-block" >Email:
                        <a  id="email" class="disabled"><?php echo  mb_strimwidth($prop->email, 0, 10,  "xxx") ?></a>
                    </li>
                    @if ( $prop->users->roles->role_type == 'Agent')
                        <li class="d-block" >Office Number:
                            <a  id="office_no" class="disabled" ><?php echo  mb_strimwidth($prop->office_no, 0, 10,  "xxx") ?></a>
                        </li>
                    @endif

                    <li class="d-block" >Phone Number:
                        <a  id="mobile" class="disabled" ><?php echo  mb_strimwidth($prop->mobile, 0, 10,  "xxx") ?></a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                        {{-- @include('inc.login') --}}
                            {{-- <button class="btn btn-info btn-sm btn-block mt-2" data-toggle="modal" data-target="#login">Reveal Information</button> --}}
                            <a href="{{ route('login')}}" class="btn btn-info btn-sm btn-block mt-2">Reveal Information</a>
                        @endif

                    @else

                        @if ( Auth::user()->mobile == NULL)

                            <button  onclick="error()"class="btn btn-info btn-sm btn-block mt-1">Reveal Information</button>

                        @else
                            @include('inc.reveal')
                            <button data-toggle="modal" data-target="#reveal" class="btn btn-info btn-sm btn-block mt-1">
                                Reveal Information
                            </button>

                            @endif

                            <h6 class="mt-2">Your Information:</h6>
                            <li class="d-block">Name: {{ Auth::user()->fname }}  {{ Auth::user()->lname }}</li>
                            <li class="d-block">Email: {{ Auth::user()->email }} </li>
                            <li class="d-block">Phone Number: {{ Auth::user()->mobile }} </li>
                            {{-- <textarea name="message" id="" cols="30" rows="5" placeholder="Please add your message!" class="mt-2"></textarea>
                            <button class="btn btn-primary btn-sm btn-block mt-2"  onclick="document.getElementById('req-form-{{ Auth::user()->id}}').submit();">
                                <i class="fa fa-envelope" aria-hidden="true"></i> Request Information
                            </button> --}}
                            <form id="req-form-{{ Auth::user()->id }}"action="{{ route('storeFav', Auth::user()->id)}}"
                                method="POST" style="display: none;">
                                @csrf
                            </form>
                    @endguest
                    @guest
                        @if (Route::has('login'))
                        {{-- <a class="mt-2 btn btn-outline-success" title = "Add to Favorite" data-toggle="modal" data-target="#login"> --}}
                        <a href="{{route('login')}}" class="mt-2 btn btn-outline-success" title = "Add to Favorite">
                            <i class="fa fa-star-o fa-lg" > </i> Add Favorite
                        </a>

                        {{-- <a  class="mt-2 btn btn btn-outline-danger"  data-toggle="modal" data-target="#login"
                        title = "Report"> --}}
                        <a href="{{route('login')}}" class="mt-2 btn btn-outline-danger" title = "Report">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
                        </a>
                        @endif

                    @else
                        <a href="javascript:void(0);" onclick="document.getElementById('fav-form-{{$prop->id}}').submit();"
                            class="mt-2 btn btn-success" title = " {{ $fav == 1 ? ' Favourited' : ' Add Favorite' }}">
                            <i class="fa {{ $fav == 1 ? 'fa-star' : 'fa-star-o ' }} text-warning" ></i> {{ $fav == 1 ? 'Favourited' : 'Add Favorite' }}
                        </a>

                        <a href="javascript:void(0);" class="mt-2 btn btn-outline-danger" data-toggle="modal" data-target="#rep">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
                        </a>

                        <form id="fav-form-{{ $prop->id }}"action="{{ route('storeFav',$prop->id)}}"
                            method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
            <div class="col-md-9 order-md-1">
                <div class="property-details">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php $i = 1;@endphp
                            @foreach ($propImages as $image)
                            <div class="carousel-item {{$i == 1 ? 'active' : ''}}">
                                @php $i++;@endphp
                                <img  style="height:70vh !important; object-fit: cover" class="d-block w-100 thumbnail"
                                src="{{ secure_asset('property/'.$prop->user_id.'/'. $image->property_id .'/'.$image->property_images)}}"
                                alt="First slide">
                            </div>
                        @endforeach

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>

                    <div class="text">

                        <span class="subheading my-3">{{ $prop->prop_location }} </span>
                        <h4 class="mb-0">&#8369;  {{ number_format($prop->price) }}</h4>
                        <h2>{{ $prop->proj_name}}</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mt-2">Full Description</h5>
                            <hr>
                            <div class="container">
                                <p class="mt-2 text-justify">{!! $prop->desc !!}</p>
                            </div>
                            {{-- comment --}}
                            <h5 class="mt-5"><strong> Comments</strong></h5>
                            <hr>
                            <div class="container">
                                @comments(['model' => $prop])

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
@section('script')

<script>
      function error(){
        alert('Fill up your phone number to reveal information!');
    }
</script>
@endsection
