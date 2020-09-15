@extends('layouts.auth')



@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <img src="{{asset('assets/images/bloo_logo.png')}}" style="width: 130px;">
                    <div class="panel-title" >
                        <h5>{{ __('Verify Your Email Address') }}</h5>
                    </div>
                </div>
                <div class="panel-body">
                    
                     @if (session('resent'))
                        <div class="alert alert-success" role="alert"  >
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" style="" action="{{ route('verification.resend') }}">
                        @csrf
                        <br>
                        <button type="submit"  style="background-color: #0065a1; height: 34px;" class="btn btn-link p-0 m-0 align-baseline"><p style="color: #fff;">{{ __('click here to request another') }}</p></button>.
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"  style="background-color: #0065a1;" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
