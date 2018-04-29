@extends('layouts.website')

@section('content')
<div class="containerLg">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="authForm">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="authFormHeader">
                        <h3 class="authFormTitle">Stujobs <span class="beta">Beta</span></h3>
                        <h3 class="authFormSubtitle">Connexion</h3>
                    </div>
                    <div class="authFormContent">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="inputGroup">
                                    <label for="email">Adresse email</label>
                                    <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="inputGroup">
                                    <label for="password">Mot de passe</label>
                                    <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="inputGroup">
                                    <label for="remember">Garder la session</label>
                                </div>
                                <input type="checkbox" name="remember" class="checkboxInput" {{ old('remember') ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="authFormFooter">
                        <button type="submit" class="buttonActionLg bgPrimary submit-btn">Connexion</button>
                        <a class="buttonLink" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
