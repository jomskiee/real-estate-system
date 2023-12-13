<!-- Modal -->
<div class="modal fade" id="rep" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style=" color: red">Report : </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <div class="overflow">
                    <div class="col-md-12 col-xs-12">

                        <form action="{{ route('storeRep', $prop->id) }}" method="POST">
                            @csrf
                            <div class="form-group" style="color: #000">
                                <label for="subject">Subject:<small class="text-danger">(required)</small></label>
                                <input type="text" class="form-control  @error('subject') is-invalid @enderror" name="subject" required>
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" style="color: #000">
                                <label for="description">Description:<small class="text-danger">(required)</small></label>
                                <textarea rows="10" name="desc" class="form-control" required></textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-danger"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

