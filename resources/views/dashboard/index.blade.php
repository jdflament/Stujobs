@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Statistiques</div>
                    <div class="card-body">
                        Voici les dernières annonces postées non validées...<br /> <br />

                        Quelques statistiques :
                        <ul>
                            <li>Nombre d'annonce en ligne (pie chart validées/terminées/non validées)</li>
                            <li>Nombre d'email dans la newsletter</li>
                            <li>Nombre d'entreprise inscrites sur le site</li>
                            <li>Nombre d'administrateurs et de super administrateur</li>
                            <li>Nombre de visiteur par mois</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Types de contrats proposés
                    </div>
                    <div class="card-body">
                        <canvas id="pieContractType"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: 25px;">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Informations sur les offres
                    </div>
                    <div class="card-body">
                        <canvas id="pieOffersInfos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        Test
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
@endsection
