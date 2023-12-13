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
    <div class="container my-5">
        @include('inc.notif')
        <div class="clearfix" >
            <div class="card-header">
                <h3 class="text-center">
                    SUBMIT YOUR PROPERTY <br>
                </h3>
            </div>
            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                                <label for="proj_name">Property Name<small class="text-danger">*</small></label>
                                <input id="proj_name" type="text" class="form-control @error('proj_name') is-invalid @enderror" name="proj_name" required>
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
                                    <option value="">-- Please select --</option>
                                    @foreach ($prop_type as $item)
                                        <option value="{{ $item->id }}">{{ $item->prop_type }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="price">Property price <small class="text-danger">*</small></label>
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required>
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
                                <input type="text" class="form-control @error('prop_location') is-invalid @enderror"   name="prop_location" required/>
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
                                    <textarea name="desc" id="summerNote" class="form-control @error('desc') is-invalid @enderror"></textarea>
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
                                        <input type="file" id="files" name="files[]" class="file" multiple data-browse-on-zone-click="true" data-show-upload="false" required>
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
    <script>

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

        // $(document).on("ready", function() {
        //     $("#files").fileinput({
        //         theme: 'fas',
        //         uploadUrl: "my-dashboard/properties", // your upload server url
        //         uploadExtraData:{'_token':$("#csrf_token").val()},
        //         allowedFileTypes: ['image','jpeg','jpg'],
        //         maxFileCount: 10,
        //         overwriteInitial: false,
        //         showRemove: false,
        //     });
        // });



    </script>
  @endsection
