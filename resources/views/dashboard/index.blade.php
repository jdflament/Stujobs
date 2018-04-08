@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Offres à valider</div>
                    <div class="card-body" style="max-height: 350px; overflow-y: scroll;">
                        <div class="list-group">
                            @if (count($offersToValid) > 0)
                                @foreach ($offersToValid as $offerToValid)
                                    <a href="/dashboard/offers/{{ $offerToValid->id }}/show" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between" style="display: -webkit-box !important">
                                            <h5 class="mb-1 text-truncate">{{ $offerToValid->title }} <span style="font-size: 12px">(@lang('vocabulary.' . $offerToValid->contract_type))</span></h5>

                                            <small class="badge badge-primary">{{ (new Carbon\Carbon($offerToValid->created_at))->diffForHumans() }}</small>
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
                        Voici les dernières annonces postées non validées...<br /> <br />

                        Quelques statistiques :
                        <ul>
                            <li>Nombre d'email dans la newsletter</li>
                            <li>Nombre d'entreprise inscrites sur le site</li>
                            <li>Nombre d'administrateurs et de super administrateur</li>
                            <li>Nombre de visiteur par mois</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
@endsection
