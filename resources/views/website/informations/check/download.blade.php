@extends('layouts.website')

@section('content')
<div class="containerLg">
    <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Confirmation du téléchargement de la copie totale de vos données</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 marginTop">
                <div class="boxEffect">
                    <h3 class="boxTitle centerContent">Entrer le code de vérification reçu à l'adresse : <b>{{ $_GET['email'] }}</b></h3>
                    <form name="checkCode" role="form" method="post" action="/informations/check/download">
                        <div class="inputGroup">
                            <label for="code_check">Votre code reçu par mail</label>
                            <input type="text" id="code_check" name="code_check" required="required" placeholder="Votre code reçu par mail" />
                            @if ($errors->has('code_check'))
                                <div class="error">{{ $errors->first('code_check') }}</div>
                            @endif
                            <input type="hidden" name="guest_email" id="guest_email" value="{{ $_GET['email']}}"  />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <br />
                            <div class="flexCenter">
                                <button type="submit" class="buttonActionLg bgPrimary submit-btn">Valider</button>
                            </div>
                        </div>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection