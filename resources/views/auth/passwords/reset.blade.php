@extends('layouts.website')

@section('content')
<div class="containerLg">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="boxEffect">
                <div class="boxEffectHeader">
                    <h3 class="boxEffectTitle">Réinitialiser le mot de passe</h3>
                </div>

                <div class="boxEffectContent">
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="inputGroup">
                                    <label for="email">Adresse email</label>
                                    <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="inputGroup">
                                    <label for="password">Mot de passe</label>
                                    <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="inputGroup">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmation du mot de passe</label>
                                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Réinitialiser le mot de passe
                                </button>
                            </div>
                        </div>

                        <div class="row centerContent" style="margin-top: 25px;">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <button type="submit" class="buttonActionLg bgPrimary">
                                    <i class="fa fa-refresh"></i> Réinitialiser le mot de passe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
