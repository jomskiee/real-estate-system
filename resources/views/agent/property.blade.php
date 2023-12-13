@extends('layouts.navbar')


@section('content')

<section class="d-flex align-items-center" style="background-color: #21243D;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white">Property Management</h2>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        @include('inc.notif')

        <div class="row d-flex justify-content-end mr-1">
            <a href="{{ route('properties.create') }}" class="text-decoration-none mt-5"><button class="btn btn-primary">Upload property</button>
        </div>

        <div class="row mt-5">
            @if(count($properties) > 0)

            @foreach ($properties as  $property)
            @include('inc.delete')
                <div class="col-md-4">
                    <div class="property-wrap ftco-animate">
                        @foreach ($images as $image)
                        @if ($image->property_id == $property->id)
                            <a href="{{ $property->publish == 1 ? '#' : route('properties.edit', $property->id) }}" class="img" data-toggle = "tooltip"
                                title = "{{ $property->publish == 0 ? 'Edit Property' : 'Unpublish Property to edit Property'}}"
                                style="background-image: url({{ asset('property/'.$image->properties->user_id.'/'. $image->property_id .'/'.$image->property_images)}});
                                    background-size: cover; background-position: center;">
                                <div class="rent-sale d-flex justify-content-between">
                                    <span class="sale">{{ $property->prop_type}}</span>

                                </div>
                                <p class="price"><span class="orig-price">&#8369;  {{number_format($property->price)  }}</span></p>
                            </a>
                            @endif
                        @endforeach
                        <div class="text">
                            <ul class="property_list">
                                <li>
                                    <span id="badge-{{$property->id}}" class="badge {{$property->publish == 1 ? 'badge-primary' : 'badge-danger'}}" >
                                        {{$property->publish == 1 ? 'Publish Property' : 'Unpublish Property'}}
                                    </span>

                                </li>
                            </ul>

                            <h3><a href="{{ route('viewProp', $property->slug) }}" target="_blank" data-toggle = "tooltip" title = "View Property">{{ Str::limit( $property->proj_name , 25)}}</a></h3>
                            <div class="d-flex justify-content-between">
                                <span class="location">{{ Str::limit($property->prop_location, 20) }}</span>
                                <span class="text-right">{{ date('F d, Y', strtotime($property->created_at )) }}</span>
                            </div>

                            <a href="{{ route('viewProp', $property->slug) }}" target="_blank" class="d-flex align-items-center justify-content-center btn-custom" data-toggle = "tooltip" title = "View Property">
                                <span class="fa fa-link"></span>
                            </a>
                            <div class=" mt-2 pt-2 border-top d-flex justify-content-between">
                                @if( count($reports) > 0)
                                        @foreach ($reports as $rep)
                                            @if ($rep->property_id == $property->id)
                                                <a href="{{ route('repProp', $property->id )}}" class="btn btn-outline-danger btn-sm mb-0 btn-block">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View Report
                                                </a>
                                            @else
                                            <a href="#deleteProperty{{ $property->id }}" role ="button" data-toggle="modal"
                                            class="btn btn-outline-danger btn-sm mb-0 ">Delete Property</a>
                                            <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                                            <input
                                            data-id="{{$property->id}}"onchange="publish(this);" id ="checkbox" type="checkbox"
                                            name="publish" data-toggle="switchbutton"  data-size="sm" data-onlabel="|"
                                            data-offlabel="0" value="{{$property->publish}} "{{ $property->publish == 1 ? 'checked' : '0' }}>
                                            @endif
                                        @endforeach
                                @else
                                    <a href="#deleteProperty{{ $property->id }}" role ="button" data-toggle="modal"
                                    class="btn btn-outline-danger btn-sm mb-0">Delete Property</a>
                                    <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />

                                    <input data-id="{{$property->id}}"onchange="publish(this);" id ="checkbox" type="checkbox"
                                    name="publish" data-toggle="switchbutton"  data-size="sm"  data-onlabel="Publish"
                                    data-offlabel="Unpublish" value="{{$property->publish}} "{{ $property->publish == 1 ? 'checked' : '0' }}>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <h6 class="d-flex justify-content-center">No properties found!</h6>
            @endif
        </div>
        <div class="row my-5">
          <div class="col d-flex justify-content-center">
            <div class="block-27">
              <ul>
                {{ $properties->links('pagination') }}
              </ul>
            </div>
          </div>
        </div>
</section>

     <!-- /.content -->

@endsection

@section('script')

<script>
    function publish(status){
        var apply = $(status).is(':checked') ? 1 : 0;
        var id = $(status).data('id');
        // alert(id);
        // console.log(apply);
        $.ajax({
            type: "POST",
            url: "/my-dashboard/properties/publish/" + id,
            dataType: 'json',
            data: {
                    "publish": apply,
                    "_token": $("#csrf_token").val()
                },
            success: function(res){
                alert(res['success']);
                setInterval('location.reload()', 7000);

                if (res['data'] == 'Publish Property') {
                    $('#badge-'+ id).toggleClass('badge-primary badge-danger').text(res['data']);
                } else {
                    $('#badge-'+ id).toggleClass('badge-primary badge-danger').text(res['data']);
                }
            }
        });
    };

</script>
@endsection
