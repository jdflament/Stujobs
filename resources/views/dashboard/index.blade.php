@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-3 col-lg-3">
                <div class="boxEffect boxNumber">
                    <i class="fa fa-envelope colorPrimary"></i>
                    <div class="boxNumberRight">
                        <h6>Emails newsletter</h6>
                        <u>{{ $totalEmailNewsletter }}</u>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <div class="boxEffect boxNumber">
                    <i class="fa fa-building colorSuccess"></i>
                    <div class="boxNumberRight">
                        <h6>Entreprises inscrites</h6>
                        <u>{{ $totalCompanies }}</u>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <div class="boxEffect boxNumber">
                    <i class="fa fa-user colorWarning"></i>
                    <div class="boxNumberRight">
                        <h6>Administrateurs</h6>
                        <u>{{ $totalAdmins }}</u>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
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
            <div class="col-xs-12 col-md-8 col-lg-8">
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
                                        <span class="listSubtitle">posté par <span class="colorDark">{{ $offerToValid->name ? $offerToValid->name : $offerToValid->email }}</span></span>
                                        <span class="listLabel @lang('vocabulary.contract_type_bgcolors.' . $offerToValid->contract_type)">@lang('vocabulary.contract_type.' . $offerToValid->contract_type)</span>
                                        <?php
                                            $date = new \Carbon\Carbon($offerToValid->created_at);
                                            $date::setLocale('fr');
                                        ?>
                                        <span class="listDate">{{ $date->diffForHumans() }}</span>
                                    </a>
                                @endforeach
                            @else
                                <div class="emptyList">
                                    <p>Aucune offre n'a été trouvée.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4">
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
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur les offres</h3>
                    </div>
                    <div class="boxEffectContent">
                        <canvas id="pieOffersInfos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Nombre d'offres d'emploi par jour</h3>
                    </div>
                    <div class="boxEffectContent">
                        <canvas id="lineOffersRates"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="containerLg">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Candidatures à valider</h3>
                    </div>
                    <div class="boxEffectContent">
                        <div class="listGroup">
                            @if (count($appliesToValid) > 0)
                                @foreach ($appliesToValid as $applyToValid)
                                    <a class="listItem" href="/dashboard/applies/{{ $applyToValid->apply_id }}/show">
                                        <span class="listTitle">{{ $applyToValid->apply_firstname }} {{ $applyToValid->apply_lastname }}</span>
                                        <span class="listSubtitle">a candidaté pour l'offre <span class="colorDark">{{ $applyToValid->offer_title }}</span></span>
                                        <span class="listLabel {{ $applyToValid->apply_cv_filename ? 'bgSuccess' : 'bgWarning' }}">{{ $applyToValid->apply_cv_filename ? 'Avec CV' : 'Sans CV' }}</span>
                                        <?php
                                        $date = new \Carbon\Carbon($applyToValid->apply_created_at);
                                        $date::setLocale('fr');
                                        ?>
                                        <span class="listDate">{{ $date->diffForHumans() }}</span>
                                    </a>
                                @endforeach
                            @else
                                <div class="emptyList">
                                    <p>Aucune candidature n'a été trouvée.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Nombre de candidatures par jour</h3>
                    </div>
                    <div class="boxEffectContent">
                        <canvas id="lineAppliesRates"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur les candidatures</h3>
                    </div>
                    <div class="boxEffectContent">
                        <canvas id="horizontalBarAppliesInfos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
@endsection
