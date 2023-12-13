@extends('layouts.navbar')
@section('content')

<section class="d-flex align-items-center" style="background-color: #1e2030;">
    <div class="container" style="margin-top: 200px; ">
        <div class="row">
            <div class="col-md-12">
                <div class="search-wrap-1 ftco-animate p-4 mb-5" >
                    <form action="{{ route('search') }}" method="GET"  class="search-property-1" autocomplete=”off” >
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-3">
                                <div class="form-group">
                                    <label for="#">Keyword</label>
                                    <div class="form-field">
                                        <div class="icon"><span class="fa fa-search"></span></div>
                                        <input type="search" name="property_search" class="form-control col-sm-10"
                                        placeholder="Search property by locations, prices, property name">
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
                                                <option value="" selected >All Properties</option>

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
<section class="ftco-section goto-here">
    <div class="container">
        <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">LISTED PROPERTIES</span>
        <h2 class="mb-2">Properties</h2>
      </div>
    </div>

    <div class="row">
        @if(count($property) > 0)
            @foreach ($property as $item)
            <div class="col-md-4">
                <div class="property-wrap ftco-animate">
                    @foreach ($images as $image)
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
                            {{-- <li><i class="fa fa-eye" aria-hidden="true"></i> {{$item->stat_view }}</li> --}}
                        </ul>
                        <span class="location" style="font-size: 12px; text-transform: uppercase;
                        font-weight: 600; letter-spacing: 2px; color: rgba(0, 0, 0, 0.4);">{{ Str::limit($item->prop_location, 25)}}</span>
                        <h3 class="my-1"><strong><a href="{{ route('viewProp', $item->slug) }}">{{ Str::limit($item->proj_name, 25)}}</a></strong></h3>
                        <a href="{{ route('viewProp', $item->slug) }}" class="d-flex align-items-center justify-content-center btn-custom">
                            <span class="fa fa-link"></span>
                        </a>
                        <div class="list-team d-flex align-items-center mt-2 pt-2 border-top">
                            <div class="d-flex align-items-center">
                                <div class="img" style="background-image: url({{ url('/avatars', $item->avatar) }} );"></div>
                                <h3 class="ml-2">{{$item->fname}} {{$item->lname}}</h3>

                            </div>
                            <span class="text-right">{{ $item->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <h6 class="d-flex justify-content-center">No properties found!</h6>
        @endif
    </div>
    <div class="row mt-5">
      <div class="col d-flex justify-content-center">
        <div class="block-27">
          <ul>
            {{ $property->links('pagination') }}
          </ul>
        </div>
      </div>
    </div>
    </div>
</section>


@endsection
