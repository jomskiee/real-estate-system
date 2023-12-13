@extends('layouts.navbar')

@section('style')
    <style>
.top-space {
  margin-top: 100px;
}

.image-class {
  min-height: 240px;
  background-color: whitesmoke;
}

.card .card-limiter {
  min-height: 285px;
}
    </style>
@endsection
@section('content')
{{-- searching --}}
<section class="hero-wrap d-flex align-items-center" style="background-image:url('{{url('/')}}/images/background_5.jpg');">
    @include('inc.notif')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-wrap-1 ftco-animate p-4">
                    <form action="{{ route('search') }}" method="GET"  class="search-property-1">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-3">
                                <div class="form-group">
                                    <label for="#">Keyword</label>
                                    <div class="form-field">
                                        <div class="icon"><span class="fa fa-search"></span></div>
                                        <input type="search" name="property_search" class="form-control col-sm-10"
                                        placeholder="Search property by locations, prices, property name"  autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 my-3">
                                <div class="form-group">
                                    <label for="#">Property Type</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="property_type" class="form-control col-sm-10" onchange="this.form.submit();">
                                                <option value="" disabled selected hidden>Property Type</option>
                                                @foreach ($prop as $item)
                                                <option value="{{$item->id}}" class="text-dark">{{$item->prop_type}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg align-self-end">
                                <div class="form-group">
                                    <div class="form-field">
                                        <input type="submit" value="Search" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                </div>
        </div>
    </div>
</section>

{{-- Most Viewed Prop --}}
  <section class="ftco-section bg-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
            <span class="subheading">Properties</span>
            <h2 class="mb-2">Most Viewed Property</h2>
        </div>
      </div>
      <div class="row ftco-animate">
        @if(count($property) > 0)
            @foreach ($property as $item)
            <div class="item col-sm-4">
                <div class="property-wrap ftco-animate">
                    @foreach ($images as $image)
                        @if ($image->property_id == $item->id)
                        <a href="{{ route('viewProp', $item->slug) }}" class="img" style="background-image: url({{secure_asset('property/'.$item->user_id.'/'. $image->property_id .'/'.$image->property_images)}});">
                            <div class="rent-sale">
                                <span class="sale">{{ $item->prop_type }}</span>
                            </div>
                            <p class="price"><span class="orig-price">&#8369;  {{number_format($item->price)  }}</span></p>
                        </a>
                        @endif
                    @endforeach
                    <div class="text">
                        <ul class="property_list">
                            <li><i class="fa fa-eye" aria-hidden="true"></i>  {{ $item->stat_view }}</li>
                        </ul>
                        <span class="location" style="font-size: 12px; text-transform: uppercase;
                        font-weight: 600; letter-spacing: 2px; color: rgba(0, 0, 0, 0.4);">{{ Str::limit($item->prop_location, 25)}}</span>
                        <h3 class="my-1"><strong><a href="{{ route('viewProp', $item->slug) }}">{{ Str::limit($item->proj_name, 25)}}</a></strong></h3>
                        <a href="{{ route('viewProp', $item->slug) }}" class="d-flex align-items-center justify-content-center btn-custom">
                            <span class="fa fa-link"></span>
                        </a>
                        <div class="list-team d-flex align-items-center mt-2 pt-2 border-top">
        					<div class="d-flex align-items-center">
	        					<div class="img" style="background-image: url({{ secure_asset('avatars', $item->avatar) }} );"></div>
	        					<h3 class="ml-2">{{$item->fname}} {{$item->lname}}</h3>
	        				</div>
	        				<span class="text-right">{{ $item->created_at->diffForHumans()}}</span>
        				</div>
                    </div>
                </div>
            </div>
            @endforeach
          @else
          <h6>No properties uploaded in the website!</h6>
          @endif
      </div>
    </div>
  </section>

  {{-- latest Prop --}}

  <section class="ftco-section bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <span class="subheading">Properties</span>
                <h2 class="mb-2 text-white">Latest Property</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    @if(count($latest) > 0)
                        @foreach ($latest as $item)
                        <div class="item">
                            <div class="property-wrap ftco-animate">
                                @foreach ($pics as $image)
                                    @if ($image->property_id == $item->id)
                                    <a href="{{ route('viewProp', $item->slug) }}" class="img" style="background-image: url({{ secure_asset('property/'.$item->user_id.'/'. $image->property_id .'/'.$image->property_images)}});">
                                        <div class="rent-sale">
                                            <span class="sale">{{ $item->prop_type }}</span>
                                        </div>
                                        <p class="price"><span class="orig-price">&#8369;  {{number_format($item->price)  }}</span></p>
                                    </a>
                                    @endif
                                @endforeach

                                <div class="text">
                                    <ul class="property_list">
                                        <li><i class="fa fa-eye" aria-hidden="true"></i>  {{ $item->stat_view }}</li>
                                    </ul>
                                    <span class="location" style="font-size: 12px; text-transform: uppercase;
                                    font-weight: 600; letter-spacing: 2px; color: rgba(0, 0, 0, 0.4);">{{ Str::limit($item->prop_location, 25)}}</span>
                                    <h3 class="my-1"><strong><a href="{{ route('viewProp', $item->slug) }}">{{ Str::limit($item->proj_name, 25)}}</a></strong></h3>
                                    <a href="{{ route('viewProp', $item->slug) }}" class="d-flex align-items-center justify-content-center btn-custom">
                                        <span class="fa fa-link"></span>
                                    </a>
                                    <div class="list-team d-flex align-items-center mt-2 pt-2 border-top">
                                        <div class="d-flex align-items-center">
                                            <div class="img" style="background-image: url({{ secure_asset('avatars', $item->avatar) }} );"></div>
                                            <h3 class="ml-2">{{$item->fname}} {{$item->lname}}</h3>
                                        </div>
                                        <span class="text-right">{{ $item->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <h6>No properties uploaded in the website!</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
  </section>

{{-- statistical --}}
<section class="ftco-counter img bg-light" id="section-counter"  >
    <div class="container">
        <div class="row pt-md-5">
      <div class="col-md-4 col-lg-4 justify-content-center counter-wrap ftco-animate">
        <div class="block-18 py-5 mb-4">
          <div class="text text-border d-flex align-items-center justify-content-center">
            <strong class="number">{{ count($properties)}}</strong>
            <span class="text-success"><i class="fa fa-home fa-3x" aria-hidden="true"></i></span>
            <span>Properties Posted</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-4 justify-content-center counter-wrap ftco-animate">
        <div class="block-18 py-5 mb-4">
          <div class="text text-border d-flex align-items-center justify-content-center">
            <strong class="number">{{ $visitors }}</strong>
            <span class="text-success"><i class="fa fa-users fa-2x" aria-hidden="true" ></i></span>
            <span>Total Visits</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-4 justify-content-center counter-wrap ftco-animate">
        <div class="block-18 py-5 mb-4">
          <div class="text d-flex align-items-center justify-content-center">
            <strong class="number">{{ count($users)}}</strong>
            <span class="text-success"><i class="fa fa-users fa-2x" aria-hidden="true" ></i></span>
            <span>Registered Users</span>
          </div>
        </div>
      </div>
    </div>
    </div>
</section>


{{-- Testimony --}}

@if (count($test) > 0)
<section class="ftco-section testimony-section " style="background-color: #1e2030;">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Testimonial</span>
          <h2 class="mb-3 text-white">Happy Clients</h2>
        </div>
      </div>
      <div class="row ftco-animate">
        <div class="col-md-12">
            <div class="carousel-testimony owl-carousel text-center">
                @foreach ($test as $item)
                <div class="mx-1 row justify-content-center">
                  <div class="card">
                    <div class="card-img-top mt-2 d-block justify-content-center">
                            <img src="{{ secure_asset('avatars/'.$item->users->avatar) }}" class=" img-fluid col-sm-4 offset-sm-4">
                            <h6 class="mt-2 mb-0"><strong>{{ strtoupper($item->users->fname) }} {{ strtoupper($item->users->lname) }} </strong></h6>
                            <p class=""><strong>{{ $item->users->roles->role_type}}</strong></p>
                      </div>
                    <div class="card-body card-limiter">

                        <div class="d-block justify-content-center">
                            <p class="">
                                <i class="fa fa-quote-left text-success float-left" aria-hidden="true"></i>
                                <strong>{!! $item->testimonial!!}</strong>
                                <i class="fa fa-quote-right  text-success float-right" aria-hidden="true"></i>
                            </p>
                        </div>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
        </div>

      </div>
    </div>
</section>
@endif






@endsection
