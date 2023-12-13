@extends('layouts.navbar')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image:url('{{url('/')}}/images/background_5.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate pb-0 text-center">
            <h1 class="mb-3 bread">Contact Us</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container">
      <div class="row block-9 justify-content-center mb-5">
        <div class="col-md-8 mb-md-5">
            <h2 class="text-center">If you got any questions <br>please do not hesitate to send us a message</h2>
          <form action="{{ route('send.contact') }}" method="POST" class="bg-light p-5 contact-form">
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
      <div class="row d-flex mb-5 contact-info justify-content-center">
          <div class="col-md-8">
              <div class="row mb-5">
                <div class="col-md-4 text-center py-4">
                    <div class="icon">
                        <span class="fa fa-map"></span>
                    </div>
                  <p><span>Address:</span>Poblacion, Quezon, Bukidnon, PHILIPPINES</p>
                </div>
                <div class="col-md-4 text-center border-height py-4">
                    <div class="icon">
                        <span class="fa fa-phone"></span>
                    </div>
                  <p><span>Phone:</span> <a href="tel://1234567920">+63 995 801 4272</a></p>
                </div>
                <div class="col-md-4 text-center py-4">
                    <div class="icon">
                        <span class="fa fa-paper-plane"></span>
                    </div>
                  <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                </div>
              </div>
        </div>
      </div>
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div id="map" class="bg-white"></div>
          </div>
      </div>
    </div>
  </section>
@endsection
