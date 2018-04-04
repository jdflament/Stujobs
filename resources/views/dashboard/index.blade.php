@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="chart-block">
                            <h3 style="text-align: center">Types de contrats proposés</h3>
                            <canvas id="pieContractType" width="200" height="200"></canvas>
                        </div>
                        Voici les dernières annonces postées non validées...<br /> <br />

                        Quelques statistiques :
                        <ul>
                            <li>Nombre d'annonce en ligne (pie chart validées/terminées/non validées)</li>
                            <li>Nombre d'email dans la newsletter</li>
                            <li>Nombre d'entreprise inscrites sur le site</li>
                            <li>Nombre d'administrateurs et de super administrateur</li>
                            <li>Nombre de visiteur par mois</li>
                            <li>Nombre de type de contrat proposé (bar charts)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
