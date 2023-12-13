@extends('layouts.sDashboard')

@section('content')


  <section class="ftco-section contact-section">
    <div class="container">

      <div class="row block-9 justify-content-center mb-5">
        <div class="col-md-8 mt-5">
            <h4 class="text-center">Contact Us</h4>
            <h6 class="text-center">If you got any questions <br>please do not hesitate to send us a message</h6>
          <form action="{{ route('sendConcern') }}" method="POST" class="bg-light p-5 contact-form">
              @csrf
            @if (session()->has('message'))
                <div class="alert-alert-success" style="color: green;">
                    {{ session()->get('message') }}
                </div>

            @endif
            <div class="form-group">
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
              @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject">
              @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <textarea name="content" id="" cols="30" rows="7" class="form-control @error('content') is-invalid @enderror" placeholder="Message"></textarea>
              @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
            </div>
          </form>

        </div>
      </div>
    </div>
@endsection
