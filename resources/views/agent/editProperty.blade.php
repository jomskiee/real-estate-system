@extends('layouts.navbar')



@section('content')
<section class="d-flex align-items-center" style="background-color: #21243D;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white"></h2>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container my-5">
        @include('inc.notif')
        <div class="clearfix" >
            <div class="card-header">
                <h3 class="text-center">
                    EDIT YOUR PROPERTY <br>
                </h3>
            </div>
            <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                <div class="card  card-body bg-white my-4" >
                    <div class="row ">
                        <div class="col-sm-12">
                            <h5 class="info-text text-center py-3"> LISTING INFORMATION</h5>
                        </div>
                        <div class="col-sm-5 mx-2">
                            <h5><strong> Property Contact:</strong></h5>
                            <p class="mb-0 mx-2">Listing Agent: &nbsp; {{ Auth::user()->fname }} {{ Auth::user()->lname }}</p>
                            <p class="mb-0 mx-2">Mobile Number: &nbsp; {{ Auth::user()->mobile }}</p>
                            <p class="mb-0 mx-2">Office Number: &nbsp; {{ $agency }}</p>
                            <p class="mb-0 mx-2">Send enquiries to: &nbsp; {{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-sm-5 mx-2">
                            <div class="form-group">
                                <label for="proj_name">Property Name<small class="text-danger">*</small> </label>
                                <input id="proj_name" type="text" class="form-control @error('proj_name') is-invalid @enderror" name="proj_name" value="{{ $property->proj_name }}" required>
                            </div>
                            @error('proj_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end of listing-->
                <div class="card  card-body bg-white my-4 " >
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="info-text text-center py-3"> PROPERTY DETAILS</h5>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label>Property Type <small class="text-danger">*</small></label>
                                <select name="property_type"  id="property_type" class="selectpicker show-tick form-control" required>
                                    @foreach ($prop_type as $item)
                                        <option value="{{ $item->id }}"
                                            @if($property->prop_type_id == $item->id) selected="selected" @endif>
                                            {{ $item->prop_type }}
                                        </option>
                                    @endforeach


                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="price">Property price <small class="text-danger">*</small></label>
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price"  value="{{$detail->price }}"required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label>Property Location: <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('prop_location') is-invalid @enderror"   name="prop_location" value="{{$detail->prop_location }}" required/>
                                @error('prop_location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Property Description :<small class="text-danger">*</small></label>
                                    <textarea name="desc" id="summerNote" class="form-control @error('desc') is-invalid @enderror">{{ $detail->desc }}</textarea>
                                    @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of details -->

                <div class="card card-body bg-white my-4" >
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Property Photos (Maximum of 10): <small class="text-danger">(required)</small></label>
                                    <h5><small><strong class="text-danger">Note: </strong> The first image in the list below will be used as the thumbnail in search results.</small></h5>
                                    <div class="file-loading">
                                        <input id="input-24" name="files[]" type="file" multiple data-show-upload="true" data-min-file-count="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-12 float-right mt-4">
                                    <div class="form-group">
                                        <input id="submit" type='submit' class='btn btn-finish btn-danger float-right'/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end of Images -->
            </form><!-- /.form -->
        </div>
    </div>
</section>

     <!-- /.content -->


@endsection

@section('script')
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--file Input-->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
    <script>
        // Summernote
        $(document).ready(function() {

            $("#summerNote").summernote({
                height: 150,
                toolbar: [
                    [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                    [ 'fontname', [ 'fontname' ] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', [ 'link'] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                ]
            });
        });
        $(document).ready(function() {
            var krajeeGetCount = function(id) {
                var cnt = $('#' + id).fileinput('getFilesCount');
                return cnt === 0 ? 'You have no files remaining.' :
                    'You have ' +  cnt + ' file' + (cnt > 1 ? 's' : '') + ' remaining.';
            };
            $("#input-24").fileinput({
                maxFileCount: 10,
                browseOnZoneClick: true,
                uploadUrl: "/my-dashboard/properties/upload_image/{{$property->id}}",
                allowedFileTypes: ['image','jpeg','jpg'],
                uploadExtraData:{'_token':$("#csrf_token").val()},
                validateInitialCount: true,
                initialPreviewFileType: 'image',
                overwriteInitial: false,
                //enableResumableUpload: true,
                initialPreview: [
                    <?php
                        foreach($images as $image)
                        {
                            $id = $image->property_id;
                            $url = $image->property_images;
                            echo '"/property/'.Auth::user()->id.'/'.$id.'/'.$url.'",';
                        }

                    ?>

                ],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    <?php
                        foreach($images as $image)
                        {
                            $id = $image->id;
                            $caption = $image->property_images;//caption
                            echo '{caption:"'.$caption.'", key:'.$id.'},';
                        }

                    ?>
                ],
                deleteUrl: "/my-dashboard/properties/delete",
                deleteExtraData:{'_token':$("#csrf_token").val()},

            }).on('filesorted', function(e, sort) {
                var images = [];
                for(i in sort.stack){
                    // console.log(sort.stack[i].key);
                    var id = sort.stack[i].key;
                    images.push(id);
                }

                $.ajax({
                    url: "/my-dashboard/properties/sort",
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data:  {
                        "data": images,
                    },
                    success: function (res) {

                    }
                });

            }).on('filebeforedelete', function() {
                var aborted = !window.confirm('Are you sure you want to delete this file?');
                if (aborted) {
                    window.alert('File deletion was aborted! ' + krajeeGetCount('input-24'));
                };
                return aborted;
            }).on('filedeleted', function() {
                setTimeout(function() {
                    $.alert('File deletion was successful! ' + krajeeGetCount('input-24'));
                }, 900);
            });
        });

    </script>
@endsection


