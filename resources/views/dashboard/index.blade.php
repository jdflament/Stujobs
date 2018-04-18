@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
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
    <div class="containerLg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Offres à valider</h3>
                    </div>
                    <div class="boxEffectContent">
                        <div class="listGroup">
                            @if (count($offersToValid) > 0)
                                @foreach ($offersToValid as $offerToValid)
                                    <a class="listItem" href="/dashboard/offers/{{ $offerToValid->id }}/show">
                                        <span class="listTitle">{{ $offerToValid->title }}</span>
                                        <span class="listSubtitle">posté par {{ $offerToValid->name ? $offerToValid->name : $offerToValid->email }}</span>
                                        <span class="listLabel">@lang('vocabulary.contract_type.' . $offerToValid->contract_type)</span>
                                        <?php
                                            $date = new \Carbon\Carbon($offerToValid->created_at);
                                            $date::setLocale('fr');
                                        ?>
                                        <span class="listDate">{{ $date->diffForHumans() }}</span>
                                    </a>
                                @endforeach
                            @else
                                <div class="noOffers">
                                    <p>Aucune offre n'a été trouvée.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Types de contrats proposés</h3>
                    </div>
                    <div class="boxEffectContent">
                        <canvas id="pieContractType"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur les offres</h3>
                    </div>
                    <div class="boxEffectContent">
                        <canvas id="pieOffersInfos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Nombre d'offre d'emploi par jour</h3>
                    </div>
                    <div class="boxEffectContent">
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
