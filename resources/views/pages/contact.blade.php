@extends('layouts.frontend.app')

@section('content')
    @section('title', 'BLOO')

@push('css')



    @endpush


    <div class="hero-wrap other-p">
        <div class="overlay"></div>
        <div class="circle-bg"></div>
        <div class="circle-bg-2"></div>
        <div class="container-fluid">
          <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
              <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">{{  trans('home_fil')  }}</a></span> <span>{{  trans('contact_fil')  }}</span></p>
              <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{  trans('contact_fil')  }}</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
           
            <h2 class="mb-4">{{ trans('contact_content') }}</h2>
            <p>{{ trans('contact_infos') }}</p>
            <p>{{ trans('contact_infos1') }}</p>
            {{-- <p>{{ trans('contact_infos3') }}</p> --}}
          </div>
        </div>

        </div>
    </section>

      <section class="ftco-section contact-section ftco-degree-bg">
        <div class="container">
          <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-4">
              <h2 class="h4">{{ trans('Contact Information') }}</h2>
            </div>
            <div class="w-100"></div>
          {{-- <div class="col-md-3">
              <p><span>{{ trans('Address') }} :</span> Bonamoussadi, <br> Douala - Cameroun</p>
            </div>--}}
           {{-- <div class="col-md-3">
              <p><span> {{ trans('Phone') }} :</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
            </div>--}}
            <div class="col-md-3">
              <p><span>{{ trans('Email') }} :</span> <a href="mailto:info@yoursite.com">hello@blooapp.live</a></p>
            </div>
            
          </div>
          <div class="row block-9">
            <div class="col-md-6 pr-md-5">
              <form action="{{route('contactus')}}" method="post">
                  @csrf
                <div class="form-group">
                  <input name="Nom" type="text" class="form-control" placeholder="{{ trans('Your Name') }}" required>
                </div>
                <div class="form-group">
                  <input name="Email" type="text" class="form-control" placeholder="{{ trans('Your EMail') }}" required>
                </div>
                <div class="form-group">
                  <input name="sujet" type="text" class="form-control" placeholder="{{ trans('Subject') }}" required>
                </div>
                <div class="form-group">
                  <textarea name="Message" id="" cols="30" rows="7" class="form-control" placeholder="{{ trans('Message') }}" required></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="{{ trans('Send Message') }}" class="btn btn-primary py-3 px-5" >
                </div>
              </form>

            </div>

            <div class="col-md-6" >
                <img src="{{ asset('assets/images/hello.jpg') }}" alt="" height=390px
                width=545px>
      </div>
          </div>
        </div>
      </section>


@push('js')


    @endpush
    @endsection
     @section('scripts')


@endsection
