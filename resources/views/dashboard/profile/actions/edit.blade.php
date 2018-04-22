@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <button data-destination="profile-password-content" class="buttonActionLg bgPrimary" data-toggle="modal" data-target="#modalChangePassword">
                    <i class="fa fa-lock"></i> Modifier mon mot de passe
                </button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Éditer mon profil</h3>
                    </div>
                    <form name="editProfile" role="form" method="post" action="/dashboard/profile/edit">
                        <div class="boxEffectContent">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="inputGroup">
                                        <label for="edit_email">Adresse email *</label>
                                        <input type="text" id="edit_email" name="edit_email" value="{{ old('edit_email') ? old('edit_email') : $admin->email }}" placeholder="Ex : john.doe@mail.com" />
                                    </div>
                                    @if ($errors->has('edit_email'))
                                        <div class="error">{{ $errors->first('edit_email') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_lastname">Nom</label>
                                        <input type="text" id="edit_lastname" name="edit_lastname" value="{{ old('edit_lastname') ? old('edit_lastname') : $admin->lastname }}" placeholder="Ex : Doe" />
                                    </div>
                                    @if ($errors->has('edit_lastname'))
                                        <div class="error">{{ $errors->first('edit_lastname') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_firstname">Prénom</label>
                                        <input type="text" id="edit_firstname" name="edit_firstname" value="{{ old('edit_firstname') ? old('edit_firstname') : $admin->firstname }}" placeholder="Ex : John" />
                                    </div>
                                    @if ($errors->has('edit_firstname'))
                                        <div class="error">{{ $errors->first('edit_firstname') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_phone">Téléphone</label>
                                        <input type="text" id="edit_phone" name="edit_phone" value="{{ old('edit_phone') ? old('edit_phone') : $admin->phone }}" placeholder="Ex : 0601020304" />
                                    </div>
                                    @if ($errors->has('edit_phone'))
                                        <div class="error">{{ $errors->first('edit_phone') }}</div>
                                    @endif
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="inputGroup">
                                        <label for="edit_office">Poste</label>
                                        <input type="text" id="edit_office" name="edit_office" value="{{ old('edit_office') ? old('edit_office') : $admin->office }}" placeholder="Ex : Développeur" />
                                    </div>
                                    @if ($errors->has('edit_office'))
                                        <div class="error">{{ $errors->first('edit_office') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="boxEffectFooter">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('dashboardIndexProfile') }}" type="button" class="buttonActionLg bgDefault" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                            <button type="submit" class="buttonActionLg bgPrimary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/profile/actions/password')    
@endsection
