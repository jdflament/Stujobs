@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xs-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Éditer mon profil
                        <!-- Button trigger modal -->
                        <button style="float: right;" data-destination="profile-password-content" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalChangePassword">
                            Modifier mon mot de passe
                        </button>
                    </div>
                    <form name="editProfile" role="form" method="post" action="/profile/edit">
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
                                        <input type="text" class="form-control" id="edit_email" name="edit_email" value="{{ old('edit_email') ? old('edit_email') : $company->email }}" />
                                    </div>
                                    @if ($errors->has('edit_email'))
                                        <div class="error">{{ $errors->first('edit_email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_name">Raison Sociale</label>
                                        <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ old('edit_name') ? old('edit_name') : $company->name }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_siret">SIRET</label>
                                        <input type="text" class="form-control" id="edit_siret" name="edit_siret" value="{{ old('edit_siret') ? old('edit_siret') : $company->siret }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_address">Adresse</label>
                                        <input type="text" class="form-control" id="edit_address" name="edit_address" value="{{ old('edit_address') ? old('edit_address') : $company->address }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_phone">Téléphone</label>
                                        <input type="text" class="form-control" id="edit_phone" name="edit_phone" value="{{ old('edit_phone') ? old('edit_phone') : $company->phone }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="text-align: right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('indexProfile') }}" type="button" class="btn btn-default" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                            <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('website/profile/actions/password')
@endsection
