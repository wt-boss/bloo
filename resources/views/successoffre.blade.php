@section('title', trans('Sucess_create'))

@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <img src="{{asset('assets/images/bloo_logo.png')}}" style="width: 130px;">
                    <div class="panel-title" >
                        <h5>@lang('Sucess_create')</h5>
                        <p>@lang('Confirmation_msg')</p>
                    </div>
                </div>
                <div class="panel-body">
                    <button  style="background-color: #0065a1;" id="submit" type="button" class="btn btn-bloo mt-5">
                        <a style="color: #fff;" href="{{ route('home') }}">
                            @lang('home')
                        </a>
                    </button>
                    <button  style="background-color: #0065a1;" id="submit" type="button" class="btn btn-bloo pull-right mt-5">
                        <a style="color: #fff;" href="{{ route('login') }}">
                            @lang('login')
                        </a>
                    </button>
                </div>
            </div>
        </div>
@endsection


