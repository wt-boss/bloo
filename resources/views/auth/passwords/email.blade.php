@extends('layouts.auth')

@section('title', 'Password Recovery')

@section('content')

<form id="login" method="post" action="{{ route('password.email') }}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center login-logo-header">
            <img alt="Bloo" src="{{ asset('assets/images/bloo_logo.png') }}">
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-body form-content">
                <div class="text-center">
                    <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                    <h5 class="content-group">Récupération de mot de passe <small class="display-block">Nous vous enverrons des instructions par e-mail</small></h5>
                </div>

                @php $status = $status ?? null; @endphp
                @includeWhen(isset($status), 'partials.alert', ['name' => 'login', 'forced_alert' => ['status' => 'success', 'message' => $status]])

                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }} has-feedback-left bloo-fg">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn  btn-block">Envoyer le lien de réinitialisation<i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/uniform.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pages/auth-passwords-email.js') }}"></script>
@endsection
