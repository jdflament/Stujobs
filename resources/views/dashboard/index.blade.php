@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-3">
                <div class="boxEffect boxNumber">
                    <i class="fa fa-envelope colorPrimary"></i>
                    <div class="boxNumberRight">
                        <h6>Emails newsletter</h6>
                        <u>{{ $totalEmailNewsletter }}</u>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="boxEffect boxNumber">
                    <i class="fa fa-building colorSuccess"></i>
                    <div class="boxNumberRight">
                        <h6>Entreprises inscrites</h6>
                        <u>{{ $totalCompanies }}</u>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="boxEffect boxNumber">
                    <i class="fa fa-user colorWarning"></i>
                    <div class="boxNumberRight">
                        <h6>Administrateurs</h6>
                        <u>{{ $totalAdmins }}</u>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="boxEffect boxNumber">
                    <i class="fa fa-eye colorDanger"></i>
                    <div class="boxNumberRight">
                        <h6>Visiteurs ce mois</h6>
                        <u>120</u>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Offres à valider</div>
                    <div class="card-body" style="height: 350px; overflow-y: scroll;">
                        <div class="list-group">
                            @if (count($offersToValid) > 0)
                                @foreach ($offersToValid as $offerToValid)
                                    <a href="/dashboard/offers/{{ $offerToValid->id }}/show" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between text-truncate" style="display: -webkit-box !important">
                                            <h5 class="mb-1">{{ $offerToValid->title }} <span style="font-size: 12px">(@lang('vocabulary.contract_type.' . $offerToValid->contract_type))</span></h5>
                                            <?php
                                                $date = new \Carbon\Carbon($offerToValid->created_at);
                                                $date::setLocale('fr');
                                            ?>
                                            <small class="badge badge-primary">{{ $date->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-1 text-truncate" style="color: inherit;">{{ $offerToValid->description }}</p>
                                        <small>Posté par {{ $offerToValid->name }}</small>
                                    </a>
                                @endforeach
                            @else
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <p>Aucune offre en cours à valider.</p>
                                </a>
                            @endif
                        </div>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Informations sur les offres
                    </div>
                    <div class="card-body">
                        <canvas id="pieOffersInfos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Nombre d'offre d'emploi par jour
                    </div>
                    <div class="card-body">
                        <canvas id="lineOffersRates"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
@endsection
