
@extends('layouts.frontend.app')
@section('page_title', trans('prix_free'))

@section('content')
<div class="hero-wrap other-p">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="{{ route('home') }}">{{trans('free__home')}}</a></span> <span>{{ trans('sondage_fil') }}</span></p>{{ trans('') }}
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{ trans('Sondage gratuit') }}</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section sondages">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="subheading">{{trans('free_header0')}}</span>
                {{-- <h2 class="mb-4 text-justify">{{trans('free_header')}}</h2> --}}
            </div>

            <div class="col-md-12 align-items-center ftco-animate">
                <div class="tab-content ftco-animate" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                        <div class="d-md-flex">
                            <div class="one-half ml-md-5 align-self-center">
                                <h2 class="mb-4 text-center-global">
                                        {{ trans('sondage_content1') }}
                                </h2>
                            </div>
                            <div class="one-half ml-md-5 align-self-center">
                                <p class="text-center-global">
                                    {{ trans('sondage_content') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light sondage">
    <div class="container">
        <div class="row d-md-flex">
            <div class="col-md-6 ftco-animate img about-image" style="border-radius: 5px; background-image: url({{asset('assets/images/avantages_bloo_okay.jpg')}});"></div>
            <div class="col-md-6 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a style="margin-top: 8px;"  class="nav-link active" id="v-pills-whatwedo-tab" data-toggle="pill" href="#v-pills-whatwedo" role="tab" aria-controls="v-pills-whatwedo" aria-selected="true">{{trans('free_content1')}}</a>

                        <a class="nav-link kr " id="v-pills-mission-tab" data-toggle="pill" href="#v-pills-mission" role="tab" aria-controls="v-pills-mission" aria-selected="false">{{trans('free_content2')}}</a>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="tab-content ftco-animate" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-whatwedo" role="tabpanel" aria-labelledby="v-pills-whatwedo-tab">
                                    <div>
                                    @if (Session::has('errors'))
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                <ul class="list-unstyled">
                                                    @foreach (Session::get('errors')->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if (Session::has('warning'))
                                            <div class="alert alert-warning" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                {{Session::get('warning')}}
                                            </div>
                                        @endif
                                        @if (Session::has('info'))
                                            <div class="alert alert-info" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                {{Session::get('info')}}
                                            </div>
                                        @endif
                                        @if (Session::has('success'))
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                {{Session::get('success')}}
                                            </div>
                                        @endif
                                        <form action="{{route('forms.store_free')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="title">{{trans('free_form1_label1')}}</label>
                                                <input type="text" minlength="3" class="form-control" id="title" name="title" placeholder="{{ trans('free_survey_form_title') }}" required>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="purpose">{{trans('free_form1_label2')}}</label>
                                                <input type="text" class="form-control" id="description" minlength="3" name="description" placeholder="{{ trans('free_survey_form_target') }}" required >
                                                </div>
                                                <div class="form-group col-12">
                                                    <button type="submit" class="btn btn-primary float-right">{{ trans('envoyer') }}</button>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-mission" role="tabpanel" aria-labelledby="v-pills-mission-tab">
                                @if (Session::has('errors'))
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        <ul class="list-unstyled">
                                            @foreach (Session::get('errors')->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('warning'))
                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        {{Session::get('warning')}}
                                    </div>
                                @endif
                                @if (Session::has('info'))
                                    <div class="alert alert-info" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        {{Session::get('info')}}
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                    <form action="{{route('forms.show_free') }}" method="post" name="form2" id="form2">
                                        <p style="color: transparent;">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non soluta amet accusamus.
                                        </p>

                                        @csrf
                                        <div class="form-group">
                                            <label for="token">Code du formulaire</label>
                                        <input id="code" type="text" class="form-control" name="code" minlength="9" placeholder="{{ trans('free_survey_form_id') }}" required>
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" class="btn btn-primary float-right">{{ trans('envoyer') }}</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form2').submit(function(e){

        // Empêcher la soumission de formulaire normale, nous le faisons bien en JS à la place
        e.preventDefault();
        // Obtenir les données du formulaire

        var data = {
            code: $('[name=code]').val(),
            _token:"{{ csrf_token() }}",
        };

        // Send the request
        $.post('/form_free', data, function(response) {
            if (response.success) {
                document.forms["form2"].submit();
            }
            else{
                console.log(response);
            }
        });

    });
</script>



@endsection

