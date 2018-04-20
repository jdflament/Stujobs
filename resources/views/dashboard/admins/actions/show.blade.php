@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexAdmins') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Compte administrateur</h3>
                    </div>
                    <div class="boxEffectContent">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table>
                            <tbody>
                                <tr>
                                    <th scope="col">Email</th>
                                    <td scope="row" data-label="Email">{{ $admin->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Rôle</th>
                                    <td scope="row" data-label="Rôle">{{ $admin->role }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Compte vérifié</th>
                                    <td scope="row" data-label="Compte vérifié">{{ $admin->verified ? 'Oui' : 'Non' }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Membre depuis le</th>
                                    <td scope="row" data-label="Membre depuis le">{{ $admin->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations complémentaires</h3>
                    </div>

                    <div class="boxEffectContent">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table>
                            <tbody>
                            <tr>
                                <th>Nom</th>
                                <td>{{ $admin->firstname ? $admin->firstname : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>Prénom</th>
                                <td>{{ $admin->lastname ? $admin->lastname : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>Téléphone</th>
                                <td>{{ $admin->phone ? $admin->phone : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>Poste</th>
                                <td>{{ $admin->office ? $admin->office : 'NC' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
