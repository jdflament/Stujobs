@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <a href="{{ route('dashboardIndexCompanies') }}" class="btn btn-dark btn-sm" style="margin-bottom: 15px;">Retour à la liste</a>
                <div class="card card-default">
                    <div class="card-header">Entreprise n°<span style="font-weight: 400;">{{ $company->id }}</span>
                    </div>

                    <div class="card-body" style="overflow-x:scroll;">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-responsive-sm table-hover table-bordered">
                            <tbody>
                            <tr>
                                <th>Email</th>
                                <td>{{ $company->email }}</td>
                            </tr>
                            <tr>
                                <th>Rôle</th>
                                <td>{{ $company->role }}</td>
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
                <div class="card card-default" style="margin-top: 42px;">
                    <div class="card-header">Informations complémentaires
                    </div>

                    <div class="card-body" style="overflow-x:scroll;">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-responsive-sm table-hover table-bordered">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
