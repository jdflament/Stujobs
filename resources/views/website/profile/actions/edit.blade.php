@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <!-- Button trigger modal -->
                <button data-destination="profile-password-content" class="buttonActionLg bgPrimary" data-toggle="modal" data-target="#modalChangePassword">
                    <i class="fa fa-lock"></i> Modifier mon mot de passe
                </button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <div class="boxEffectTitle">Éditer mon profil</div>
                    </div>
                    <form name="editProfile" role="form" method="post" action="/profile/edit">
                        <div class="boxEffectContent">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_email">Adresse email *</label>
                                        <input type="text" id="edit_email" name="edit_email" value="{{ old('edit_email') ? old('edit_email') : $company->email }}" required="required" />
                                        @if ($errors->has('edit_email'))
                                            <div class="error">{{ $errors->first('edit_email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_name">Raison Sociale *</label>
                                        <input type="text" id="edit_name" name="edit_name" value="{{ old('edit_name') ? old('edit_name') : $company->name }}" required="required" />
                                        @if ($errors->has('edit_name'))
                                            <div class="error">{{ $errors->first('edit_name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_siret">SIRET</label>
                                        <input type="text" id="edit_siret" name="edit_siret" value="{{ old('edit_siret') ? old('edit_siret') : $company->siret }}" />
                                        @if ($errors->has('edit_siret'))
                                            <div class="error">{{ $errors->first('edit_siret') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_address">Adresse</label>
                                        <input type="text" id="edit_address" name="edit_address" value="{{ old('edit_address') ? old('edit_address') : $company->address }}" />
                                        @if ($errors->has('edit_address'))
                                            <div class="error">{{ $errors->first('edit_address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_phone">Téléphone</label>
                                        <input type="text" id="edit_phone" name="edit_phone" value="{{ old('edit_phone') ? old('edit_phone') : $company->phone }}" />
                                        @if ($errors->has('edit_phone'))
                                            <div class="error">{{ $errors->first('edit_phone') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="boxEffectFooter">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('indexProfile') }}" type="button" class="buttonActionLg bgDefault" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                            <button type="submit" class="buttonActionLg bgPrimary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('website/profile/actions/password')
@endsection
