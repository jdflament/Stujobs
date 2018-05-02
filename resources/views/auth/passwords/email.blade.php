@extends('layouts.website')

@section('content')
<div class="containerLg">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="boxEffect">
                <div class="boxEffectHeader">
                    <h3 class="boxEffectTitle">Réinitialisation du mot de passe</h3>
                </div>

                <div class="boxEffectContent">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="inputGroup">
                                    <label for="email">Adresse email</label>
                                    <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row centerContent" style="margin-top: 25px;">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <button type="submit" class="buttonActionLg bgPrimary">
                                    <i class="fa fa-paper-plane"></i> Envoyer le lien de réinitialisation
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
