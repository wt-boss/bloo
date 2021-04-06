@php
$page = $form->title;
($view_type === 'preview') and $page .= ' - Preview*';
$module = ($view_type === 'preview') ? 'My Form' : config('app.name');

$fields = $form->fields()->filled()->get();
@endphp

@section('title', "{$module} | {$page}")

@extends('layouts.auth')


@section('content')
<div id="loader"></div>
<div id="form_content">
    <div class="row">
        <div class="col-md-12 text-center"><img src="{{ asset('assets/images/bloo_logo.png') }}" alt="Bloo" class="bloologoform"></div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">{{ $page }}</h5>
                </div>

                @if ($form->status === App\Form::STATUS_CLOSED)
                    <div class="panel-body">
                        {{ optional($form->availability)->closed_form_message ?? 'Sorry, this form has been closed to responses.' }}
                    </div>
                @else
                    <div class="panel-body">
                        {!! str_convert_line_breaks($form->description) !!}
                    </div>

                    <div class="panel-body">
                        @php
                            $mobile = isset($_GET['mobile'])?$_GET['mobile']:"";
                        @endphp

                        @if($mobile == "true")
                        <form id="user-form" action="{{ ($view_type === 'form') ? route('forms.responses.store.mobile2', $form->code) : "#" }}" method="{{ ($view_type === 'form') ? "post" : "get" }}" autocomplete="off">
                        @else
                        <form id="user-form" action="{{ ($view_type === 'form') ? route('forms.responses.store', $form->code) : "#" }}" method="{{ ($view_type === 'form') ? "post" : "get" }}" autocomplete="off">
                        @endif
                        @if ($view_type === 'form') @csrf @endif
                            <div id="form-fields" class="mt-15 mb-15">
                                @php $formatted_fields = []; @endphp
                                @if ($fields->count())
                                    {{-- <p class="content-group text-danger"><strong>Fields with * are required</strong></p> --}}
                                    @foreach ($fields as $field)
                                        @php $template = get_form_templates($field->template) @endphp
                                        <div class="field" data-id="{{ $field->id }}" data-attribute="{{ $field->attribute }}" data-attribute-type="{{ $template['attribute_type'] === 'string' ? 'single' : 'multiple' }}">
                                            {!! $template['main_template'] !!}
                                        </div>
                                        @php
                                            $only_attributes = ['attribute', 'template', 'question', 'required', 'options'];
                                            $formatted_fields[$field->attribute] = $field->only($only_attributes);
                                        @endphp
                                    @endforeach
                                @endif
                            </div>
                            <input type="hidden" name="site_id" value="<?= isset($_GET['site_id'])?$_GET['site_id']:""; ?>">
                            <input type="hidden" name="country_id" value="<?= isset($_GET['country_id'])?$_GET['country_id']:""; ?>">
                            <input type="hidden" name="ville" value="<?= isset($_GET['ville'])?$_GET['ville']:""; ?>">
                            <input type="hidden" name="lat" value="<?= isset($_GET['lat'])?$_GET['lat']:""; ?>">
                            <input type="hidden" name="lng" value="<?= isset($_GET['lng'])?$_GET['lng']:""; ?>">
                            <input type="hidden" name="token" value="<?= isset($_GET['token'])?$_GET['token']:""; ?>">
                            <div class="text-left mt-20">
                                <button id="submit" type="{{ ($view_type === 'form') ? 'submit' : 'button' }}" class="btn btn-primary" data-loading-text="@lang('Chargement des données')" data-complete-text="Submit Form">{{ trans('Soumettre_le_formulaire') }}</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

    @section('laraform_script1')
        <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
    @endsection

@if ($form->status === App\Form::STATUS_OPEN)
    @section('plugin-scripts')
        <script src="{{ asset('assets/js/plugins/uniform.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/autosize.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/noty.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/ion_rangeslider.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/pickadate/picker.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/pickadate/picker.date.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/pickadate/picker.time.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/pickadate/legacy.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/validation/additional-methods.min.js') }}"></script>
    @endsection

    @section('page-script')
        <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>
        <script type="text/javascript">
            function showPage() {
                document.getElementById("loader").style.display = "none";
                document.getElementById("form_content").style.display = "block";
            }
            window.addEventListener("load", function(){
                showPage();
            });
        </script>
        @include('forms.partials._script-view')
    @endsection
@endif
