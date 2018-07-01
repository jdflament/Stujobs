@extends('layouts.website')

@section('content')
<div class="containerLg">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="authForm">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="authFormHeader">
                        <h3 class="authFormTitle">Stujobs <span class="beta">Beta</span></h3>
                        <h3 class="authFormSubtitle">Inscription</h3>
                    </div>

                    <div class="authFormContent">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="inputGroup">
                                    <label for="email">Adresse E-Mail *</label>
                                    <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="inputGroup">
                                    <label for="password">Mot de passe *</label>
                                    <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="inputGroup">
                                    <label for="password-confirm">Confirmation du mot de passe *</label>
                                    <input id="password-confirm" type="password" class="{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="inputGroup">
                                    <label for="name">Nom de l'entreprise *</label>
                                    <input id="name" type="text" name="name" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="inputGroup">
                                    <label for="siret">SIRET</label>
                                    <input id="siret" type="number" class="{{ $errors->has('siret') ? ' is-invalid' : '' }}" name="siret">
                                    @if ($errors->has('siret'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('siret') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="inputGroup">
                                    <label for="address">Adresse</label>
                                    <input id="address" class="{{ $errors->has('address') ? ' is-invalid' : '' }}" type="text" name="address">
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="inputGroup">
                                    <label for="phone">Téléphone</label>
                                    <input id="phone" class="{{ $errors->has('phone') ? ' is-invalid' : '' }}" type="text" name="phone">
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="captchaGroup">
                                    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" style="display: block;">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="paragraphe centerContent marginTop">Vous pouvez vous désinscrire à tout moment en modifiant vos paramètres sur votre compte</p>

                    </div>
                    <div class="authFormFooter">
                        <button type="submit" class="buttonActionLg bgPrimary">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
