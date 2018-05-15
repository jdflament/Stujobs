@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexCompanies') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle boxTitleLogo">
                            Compte entreprise
                        </h3>
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
                                <th>Logo</th>
                                <td><div class="logoBox smallLogo" style="{{ $company->logo_filename ? 'background-size: contain;' : 'background-size: cover;' }} background-image:url('{{ $company->logo_filename ? asset('storage/logos') . '/' . $company->logo_filename : asset('storage/logos/default-image.png') }}')"></div></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $company->email }}</td>
                            </tr>
                            <tr>
                                <th>Rôle</th>
                                <td>{{ $company->role }}</td>
                            </tr>
                            <tr>
                                <th>Compte vérifié</th>
                                <td>{{ $company->verified ? 'Oui' : 'Non' }}</td>
                            </tr>
                            <tr>
                                <th>Membre depuis le</th>
                                <td>{{ $company->created_at }}</td>
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
                        <table>
                            <tbody>
                            <tr>
                                <th>Nom</th>
                                <td>{{ $company->name ? $company->name : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>SIRET</th>
                                <td>{{ $company->siret ? $company->siret : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>Téléphone</th>
                                <td>{{ $company->phone ? $company->phone : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>Adresse</th>
                                <td>{{ $company->address ? $company->address : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $company->description ? $company->description : 'NC' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
