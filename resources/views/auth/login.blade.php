@extends('layouts.auth')

@section('title', 'Prenez le controle')

@section('content')
<form id="login" method="post" action="{{ route('login') }}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center login-logo-header">
            <img alt="Bloo" src="{{ asset('assets/images/bloo_logo.png') }}">
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-body form-content">
                <div class="text-center">
                    <h3 class="content-group-lg" style="margin-top: 0;">Prenez le contrôle</h3>
                </div>

                @include('partials.alert', ['name' => 'login', 'forced_alert' => ($errors->has('email')) ? ['status' => 'danger', 'message' => $errors->first('email')] : null])

                <div class="form-group has-feedback has-feedback-left bloo-fg">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left bloo-fg">
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block">Connexion</button>
                </div>

                <div class="form-group login-options">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="remember" checked="checked">
                                Rester connecté
                            </label>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-4"><hr/></div>
    </div>
</form>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/uniform.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pages/auth.js') }}"></script>
@endsection
