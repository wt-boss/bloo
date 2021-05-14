@section('title', "Sondage Gratuit")

@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <h6>@lang('Out_free')</h6>
                     </div>
                </div>
                <div class="panel-body">
                        <button  style="background-color: #0065a1;" id="submit" type="button" class="btn btn-bloo pull-right" data-loading-text="Please Wait..." data-complete-text="Submit Form">
                            <a style="color: #fff;" href="{{ route('forms.logout_free') }}">
                                @lang('home_fil')
                            </a>

                        </button>
                </div>
            </div>
        </div>
@endsection


