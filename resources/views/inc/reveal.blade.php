<!-- Modal -->
<div class="modal fade" id="reveal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: #000">Property Agent Information : </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="overflow">
                    <div class="col-md-12 col-xs-12">

                        <div class="form-group" style="color: #000">
                            <label for="email">Name</label>
                            <input  type="text" class="form-control"value="{{ $prop->fname }}, {{ $prop->lname }}" readonly>
                        </div>
                        <div class="form-group" style="color: #000">
                            <label for="email">Email</label>
                            <input  type="text" class="form-control"value="{{ $prop->email }}" readonly>
                        </div>

                        <div class="form-group" style="color: #000">
                            <label for="email">Phone No.</label>
                            <input  type="text" class="form-control"value="{{ $prop->mobile }}" readonly>
                        </div>
                        @if ($prop->agency_type == 1)
                            <h5  style="color: #000">Agency Information:</h5>
                            <div class="form-group" style="color: #000">
                                <label for="email">Agency Name</label>
                                <input  type="text" class="form-control"value="{{ $prop->agency_name }}" readonly>
                            </div>
                            <div class="form-group" style="color: #000">
                                <label for="email">Agency Address</label>
                                <input  type="text" class="form-control"value="{{ $prop->agency_address }}" readonly>
                            </div>
                            <div class="form-group" style="color: #000">
                                <label for="email">Office No.</label>
                                <input  type="text" class="form-control"value="{{ $prop->office_no }}" readonly>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

