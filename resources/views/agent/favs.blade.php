@extends('layouts.navbar')
@section('content')
@include('inc.notif')

<section class="d-flex align-items-center" style="background-color: #21243D;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white">Favourites</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        @include('inc.notif')

        <div class="row mt-5">
        @if(count($props) > 0)
            @foreach ($props as $prop)
                <div class="col-md-4">
                    <div class="property-wrap ftco-animate">
                        @foreach ($images as $image)
                            @if ($image->property_id == $prop->id)
                            <a target="_blank" href="{{ route('viewProp', $prop->slug) }}" class="img" style="background-image: url({{ asset('property/'.$prop->user_id.'/'. $image->property_id .'/'.$image->property_images)}});">
                                <div class="rent-sale">
                                    <span class="sale">{{ $prop->prop_type }}</span>
                                </div>
                                <p class="price"><span class="orig-price">&#8369;  {{number_format($prop->price)  }}</span></p>
                            </a>
                            @endif
                        @endforeach
                        <div class="text">
                            <span class="location" style="font-size: 12px; text-transform: uppercase;
                            font-weight: 600; letter-spacing: 2px; color: rgba(0, 0, 0, 0.4);">{{ $prop->prop_location }}</span>
                            <h3 class="my-1"><strong><a target="_blank" href="{{ route('viewProp', $prop->slug) }}">{{ Str::limit($prop->proj_name, 25)}}</a></strong></h3>

                            <a target="_blank" href="{{ route('viewProp', $prop->slug) }}" class="d-flex align-items-center justify-content-center btn-custom">
                                <span class="fa fa-link"></span>
                            </a>
                            <p style="font-size: 14px; font-weight: bold; color: rgba(0, 0, 0, 0.6); ">by: {{$prop->fname}} {{$prop->lname}}</p>
                            <div class=" mt-2 pt-2 border-top">
                                <div class="d-flex justify-content-between">
                                    <a  target="_blank" href="{{ route('viewProp', $prop->slug) }}"><button type="button" class="btn btn-primary btn-sm" >
                                        View
                                    </button></a>
                                    <a href="javascript:void(0);" onclick="document.getElementById('fav-form').submit();"><button type="button" class="btn btn-danger btn-sm">
                                        Remove
                                    </button></a>
                                    <form id="fav-form"action="{{ route('delFavAge',$prop->id)}}"
                                        method="POST" style="display: none;">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h6 class="d-flex justify-content-center">No Favourited Property!</h6>
        @endif
        </div>
        <div class="row my-5">
          <div class="col d-flex justify-content-center">
            <div class="block-27">
              <ul>
                {{ $props->links('pagination') }}
              </ul>
            </div>
          </div>
        </div>
</section>
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
