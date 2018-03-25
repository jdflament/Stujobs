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
                                        <input type="text" class="form-control" id="edit_email" name="edit_email" value="{{ $admin->email }}" />
                                    </div>
                                </div>
                            </div>
                            <p style="text-align:center;">Les informations suivantes ne sont pas obligatoire</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_lastname">Nom</label>
                                        <input type="text" class="form-control" id="edit_lastname" name="edit_lastname" value="{{ $admin->lastname }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_firstname">Prénom</label>
                                        <input type="text" class="form-control" id="edit_firstname" name="edit_firstname" value="{{ $admin->firstname }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_phone">Téléphone</label>
                                        <input type="text" class="form-control" id="edit_phone" name="edit_phone" value="{{ $admin->phone }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_office">Poste</label>
                                        <input type="text" class="form-control" id="edit_office" name="edit_office" value="{{ $admin->office }}" />
                                    </div>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
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
