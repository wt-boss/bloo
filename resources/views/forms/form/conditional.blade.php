
@section('title', " BLOO|My Forms | Create a Form")

@extends('admin.top-nav')

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
@endsection

@section('content')

    <div class="panel panel-flat border-top-lg border-top-success">
        <div class="panel-heading">
            <h5 class="panel-title">{{trans("CONDITIONS MANAGEMENT")}}</h5>
        </div>
        <div class="panel-body">
            <form id="forms" method="post" action="{{route("forms.conditionalpost")}}" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="description">{{trans("I WANT TO SHOW THE QUESTIONS")}} : <span class="text-danger">*</span></label><br>
                    @foreach($questions as $key => $field)
                        <input type="checkbox"  value="{{$field->id}}" name="questions_check[]"> Question {{$key + 1 }} : {{$field->question}} {{$field->template}} <br>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="description">{{trans("WHEN")}} : <span class="text-danger">*</span></label><br>
                    <select name="questions" id="question-select" class="form-control">
                    @foreach($questions as $key => $field)
                            @if($field->template == "multiple-choices")
                              <option value="{{$field->id}}">Question {{$key + 1 }} : {{$field->question}}</option>
                            @endif
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">{{trans("IS EQUAL TO")}} : <span class="text-danger">*</span></label><br>
                    <input type="text" class="form-control" id="value" name="value" placeholder="Value"  required>
                    <input type="hidden"  value="{{$form->code}}" name="form">
                </div>

                <div class="text-right">
                    <button style="background-color: #0065a1;"  type="submit" id="submit" class="btn mt-20 btn-{{  'success' }}">{{ trans('save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
@endsection
@section('laraform_script2')
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection
