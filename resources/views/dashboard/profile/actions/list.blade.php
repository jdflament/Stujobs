@extends('layouts.dashboard')

@section('content')
    <div class="container">
    <a href="{{ route('dashboardEditProfilePage') }}" class="btn btn-primary btn-sm">
        Modifier mes informations
    </a>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-default">
                    <div class="card-header">Compte Admin
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
                                <td>{{ $admin->email }}</td>
                            </tr>
                            <tr>
                                <th>Rôle</th>
                                <td>{{ $admin->role }}</td>
                            </tr>
                            <tr>
                                <th>Membre depuis le</th>
                                <td>{{ $admin->created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-default">
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
                                <td>{{ $admin->lastname ? $admin->lastname : 'NC' }}</td>
                            </tr>
                            <tr>
                                <th>Prénom</th>
                                <td>{{ $admin->firstname ? $admin->firstname : 'NC' }}</td>
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
