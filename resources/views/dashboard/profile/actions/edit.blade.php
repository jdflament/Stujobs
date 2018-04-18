@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xs-12 col-lg-10">
                <div class="card">
                    <div class="card-header">Éditer mon profil
                        <!-- Button trigger modal -->
                        <button style="float: right;" data-destination="profile-password-content" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalChangePassword">
                                Modifier mon mot de passe
                        </button>
                    </div>
                    <form name="editProfile" role="form" method="post" action="/dashboard/profile/edit">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_email">Adresse email</label>*
                                        <input type="text" class="form-control" id="edit_email" name="edit_email" value="{{ old('edit_email') ? old('edit_email') : $admin->email }}" />
                                    </div>
                                    @if ($errors->has('edit_email'))
                                        <div class="error">{{ $errors->first('edit_email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <p style="text-align:center;">Les informations suivantes ne sont pas obligatoire</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_lastname">Nom</label>
                                        <input type="text" class="form-control" id="edit_lastname" name="edit_lastname" value="{{ old('edit_lastname') ? old('edit_lastname') : $admin->lastname }}" />
                                    </div>
                                    @if ($errors->has('edit_lastname'))
                                            <div class="error">{{ $errors->first('edit_lastname') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_firstname">Prénom</label>
                                        <input type="text" class="form-control" id="edit_firstname" name="edit_firstname" value="{{ old('edit_firstname') ? old('edit_firstname') : $admin->firstname }}" />
                                    </div>
                                    @if ($errors->has('edit_firstname'))
                                            <div class="error">{{ $errors->first('edit_firstname') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_phone">Téléphone</label>
                                        <input type="text" class="form-control" id="edit_phone" name="edit_phone" value="{{ old('edit_phone') ? old('edit_phone') : $admin->phone }}" />
                                    </div>
                                    @if ($errors->has('edit_phone'))
                                            <div class="error">{{ $errors->first('edit_phone') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_office">Poste</label>
                                        <input type="text" class="form-control" id="edit_office" name="edit_office" value="{{ old('edit_office') ? old('edit_office') : $admin->office }}" />
                                    </div>
                                    @if ($errors->has('edit_office'))
                                            <div class="error">{{ $errors->first('edit_office') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('dashboardIndexProfile') }}" type="button" class="btn btn-default" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                            <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/profile/actions/password')    
@endsection
