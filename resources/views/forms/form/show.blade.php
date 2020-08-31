@php
	$page_data = [
		'has_sticky_sidebar' => true,
		'classes' => ['body' => ' sidebar-xs has-detached-left']
    ];

    $fields = $form->fields;

    $current_user = auth()->user();
@endphp

@extends('admin.top-nav', $page_data)


@section('title', "My Forms | {$form->title}")

@section('laraform_style')
    <!-- Laraform Link Style -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

@endsection

@section('content')

@include('partials.alert', ['name' => 'show'])

<div class="panel panel-flat">
    <div class="panel-heading">
        @php $symbol = $form::getStatusSymbols()[$form->status]; @endphp
        <h5 class="panel-title">{{ $form->title }} <span class="label bg-{{ $symbol['color'] }} position-left">{{ trans($symbol['label']) }}</span></h5>
        <div class="heading-elements">
            <div class="btn-group heading-btn">
                @if(!auth()->user()->hasRole('Free'))
                    @include('forms.partials._form-menu')
                @endif
            </div>
        </div>
    </div>
    <div class="panel-body">
        {{-- {!! str_convert_line_breaks($form->description) !!} --}}
        @if (auth()->user()->hasRole('Free'))
            <div class="form-group col-xs-12">
                {{-- <label for="exampleInputEmail1"><b>{{ trans('form_code') }}</b></label> --}}
                <button class="btn pull-right" style="top:38px;" type="button"  data-clipboard-action="copy" data-clipboard-target="#token">
                    <i class="fa fa-clone" aria-hidden="true"></i>
                </button>
                <input class="form-control" style="font-size: 16px"  id="token" value="{{$form->code}}" readonly />
                <small class="form-text text-warning  col-xs-12">{{ trans('keep_code') }}</small>
            </div>
        @endif
    </div>
</div>

<div class="panel panel-body sticky-up">
    <div class="pull-right">
        <a href="{{ route('forms.responses.index', $form->code) }}" class="btn btn-primary btn-xs position-right legitRipple"><i class="fa fa-bar-chart" aria-hidden="true"></i> {{ trans('response_stats') }}</a>
        <a href="{{ route('forms.preview', $form->code) }}" class="btn btn-primary btn-xs position-right legitRipple" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> {{ trans('preview') }}</a>
        @include('forms.partials._form-share-free')

    </div>

</div>

<div class="sidebar-detached sticky">
	<div class="sidebar sidebar-default">
		<div class="sidebar-content">
			<div class="sidebar-category">
				<div class="category-title">
                    <span>{{ trans('presentation') }}</span>
					<ul class="icons-list">
						<li><a href="#" data-action="collapse"></a></li>
					</ul>
				</div>

				<div class="category-content no-padding">
					<ul class="navigation navigation-alt navigation-accordion" data-form="{{ $form->code }}">
                        <li class="navigation-header">{{ trans('select_question_type') }}</li>
                    <li><a href="javascript:void()" class="question-template" data-id="short-answer"><i class="icon-minus3"></i>{{ trans('short_question') }}</a></li>
						<li><a href="javascript:void()" class="question-template" data-id="long-answer"><i class="icon-menu7"></i>{{ trans('long_question') }}</a></li>
						<li class="navigation-divider"></li>
                    <li><a href="javascript:void()" class="question-template" data-id="multiple-choices"><i class="icon-radio-checked"></i>{{ trans('choix_unique') }}</a></li>
						<li><a href="javascript:void()" class="question-template" data-id="checkboxes"><i class="icon-checkbox-checked"></i> {{ trans('choix_mult') }}</a></li>
						{{-- <li><a href="javascript:void()" class="question-template" data-id="drop-down"><i class="icon-circle-down2"></i> Drop-down</a></li> --}}
						<li class="navigation-divider"></li>
						<li><a href="javascript:void()" class="question-template" data-id="linear-scale"><i class="icon-move-horizontal"></i> {{ trans('linear_scale') }}</a></li>
						<li class="navigation-divider"></li>
						<li><a href="javascript:void()" class="question-template" data-id="date"><i class="icon-calendar3"></i> {{ trans('date_question') }}</a></li>
						<li><a href="javascript:void()" class="question-template" data-id="time"><i class="icon-alarm"></i> {{ trans('time_question') }}</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-detached">
	<div class="content-detached">
        <form id="create-form" action="{{ route('forms.draft', $form->code) }}" method="post" autocomplete="off">
            @csrf
            <div class="questions">
                @php $formatted_fields = []; @endphp
                @if ($fields->count())
                    @foreach ($fields as $field)
                        <div class="filled" data-id="{{ $field->id }}" data-attribute="{{ $field->attribute }}">
                            @php $template = get_form_templates($field->template) @endphp
                            {!! $template['sub_template'] !!}
                        </div>
                        @php
                            $only_attributes = ['attribute', 'template', 'question', 'required', 'options'];
                            ($template['attribute_type'] === 'array') and array_push($only_attributes, 'options');
                            $formatted_fields[$field->attribute] = $field->only($only_attributes);
                        @endphp
                    @endforeach
                @endif
            </div>

            <div class="panel panel-body submit hidden">
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-xs" id="submit" data-loading-text="Enregistrement..." data-complete-text="{{ trans('Save') }}">{{ trans('save') }}</button>
                    @php $form_is_ready = in_array($form->status, [$form::STATUS_PENDING, $form::STATUS_OPEN, $form::STATUS_CLOSED]); @endphp
                    @if(auth()->user()->hasRole('Free'))
                        <a href="{{ route('forms.responses.index', $form->code) }}" class="btn btn-primary btn-xs position-right legitRipple"><i class="fa fa-bar-chart" aria-hidden="true"></i> {{ trans('response_stats') }}</a>
                    @endif
                    <a href="{{ ($form_is_ready) ? route('forms.preview', $form->code) : 'javascript:void(0)' }}" class="btn btn-primary btn-xs position-right{{ ($form_is_ready) ? '' : ' hidden' }}" target="_blank" id="form-preview"><i class="fa fa-eye" aria-hidden="true"></i> {{ trans('preview') }}</a>
                    @if(auth()->user()->hasRole('Free'))
                        @include('forms.partials._form-share-free')
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

@includeWhen(($form->status === $form::STATUS_OPEN), 'forms.partials._form-share')

@includeWhen(($form->user_id === $current_user->id), 'forms.partials._form-collaborate')

@include('forms.partials._form_availability')
@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
@endsection

@section('plugin-scripts')
	<script src="{{ asset('assets/js/plugins/uniform.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/autosize.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/noty.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap_select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/validation/additional-methods.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>
    <script src="{{ asset('assets/js/custom/detached-sticky.js') }}"></script>
    <script src="{{asset('js/dist/clipboard.js')}}"></script>
    <script>
        var toCopy  = document.getElementById( 'to-copy' ),
            btnCopy = document.getElementById( 'copy' ),
            paste   = document.getElementById( 'cleared' );

        btnCopy.addEventListener( 'click', function(){
            toCopy.select();
            paste.value = '';

            if ( document.execCommand( 'copy' ) ) {
                btnCopy.classList.add( 'copied' );
                paste.focus();

                var temp = setInterval( function(){
                    btnCopy.classList.remove( 'copied' );
                    clearInterval(temp);
                }, 600 );

            } else {
                console.info( 'document.execCommand went wrong…' )
            }

            return false;
        } );
    </script>
    <script>
        var clipboard = new ClipboardJS('.btn');

        clipboard.on('success', function(e) {
            console.log(e);
        });

        clipboard.on('error', function(e) {
            console.log(e);
        });

        // share link
        // linkedin
        $('.linkedin a').on('click', function(e){
            var url = "{{ route('forms.view', $form->code) }}";
            var title = "Replace this with a title.";
            var text = "Replace this with your share copy.";
            window.open(
                'http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(url),
                '',
                'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
        });
        // facebook
        $('.facebook a').on('click', function(e){
            var url = "{{ route('forms.view', $form->code) }}";
            window.open('http://facebook.com/sharer/sharer.php?u='+encodeURIComponent(url),
                '',
                'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0'
            );
        });
        // twitter
        $('.twitter a').on('click', function(e){
            var url = "{{ route('forms.view', $form->code) }}";
            var text = "Replace this with your text";
            window.open(
                'http://twitter.com/share?url='+encodeURIComponent(url)+'&text='+encodeURIComponent(text),
                '',
                'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0'
            );
        });
    </script>
    @include('forms.partials._script-show')
    @stack('script')
@endsection

@section('laraform_script2')
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection
