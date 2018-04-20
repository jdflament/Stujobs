@extends('layouts.website')

@section('content')
    @include('website.templates.topbox')

    <div class="containerLg">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12 centerContent">
                <h3 class="sectionTitle">Voici nos dernières offres d'emploi</h3>
            </div>
        </div>
    </div>

    <div class="containerLg">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-lg-4">
                <div class="filtersBlock boxEffect">
                    <h3 class="boxTitle centerContent">Affiner la recherche</h3>
                    <div class="filters">
                        <form method="post" action="/offers/filter/result" name="filterOffer" role="form">
                            <label>Types de contrat</label>
                            <button class="collapseButton" type="button" data-toggle="collapse" data-target="#collapseContractTypes" aria-expanded="false" aria-controls="collapseContractTypes">Voir les types de contrat <i class="fa fa-chevron-right"></i></button>
                            <ul id="collapseContractTypes" class="collapse">
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput checkboxContract" checked="checked" value="all"><span class="checkboxSpan">Tous</span></li>
                                <?php $contract_types = \Illuminate\Support\Facades\Lang::get('vocabulary.contract_type'); ?>
                                @foreach($contract_types as $key => $contract_type)
                                        <li><input type="checkbox" name="contract_type[]" class="checkboxInput checkboxContract" value="{{ $key }}"><span class="checkboxSpan">{{ $contract_type }}</span></li>
                                @endforeach
                            </ul>
                            <label>Secteur d'activité</label>
                            <button class="collapseButton" type="button" data-toggle="collapse" data-target="#collapseSectors" aria-expanded="false" aria-controls="collapseSectors">Voir les secteurs d'activité <i class="fa fa-chevron-right"></i></button>
                            <ul id="collapseSectors" class="collapse">
                                <li><input type="checkbox" name="sectors[]" class="checkboxInput checkboxSector" checked="checked" value="all"><span class="checkboxSpan">Tous</span></li>
                                <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                                @foreach($sectors as $key => $sector)
                                    <li><input type="checkbox" name="sectors[]" class="checkboxInput checkboxSector" value="{{ $key }}"><span class="checkboxSpan">{{ $sector }}</span></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="companyFilter" id="companyFilter" />
                            <?php
                                null !== request()->get('searchOffer') ? $offerFilter = request()->get('searchOffer') : $offerFilter = "";
                            ?>
                            <input type="hidden" name="offerFilter" id="offerFilter" value="{{ $offerFilter }}" />
                        </form>
                        <label>Par entreprise</label>
                        <div class="inputGroup">
                            <input type="text" name="searchOffersByCompany" class="inputForm" id="searchOffersByCompany" placeholder="Rechercher une entreprise..." />
                            <div class="inputFormRightIcon">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="boxList showMenu">
                @if (count($offers) > 0)
                    @foreach ($offers as $offer)
                        <a class="boxEffect boxOffer" href="/offers/{{ $offer->id_offer }}">
                            <div class="boxHeader">
                                <h3 class="boxTitle">{{ $offer->title }}</h3>
                                <span class="boxLabel @lang('vocabulary.contract_type_bgcolors.' . $offer->contract_type)">@lang('vocabulary.contract_type.' . $offer->contract_type)</span>
                                <?php
                                    $date = new \Carbon\Carbon($offer->created_at);
                                    $date::setLocale('fr');
                                ?>
                                <span class="boxDate">{{ $date->diffForHumans() }}</span>
                            </div>
                            <div class="boxSubtitle">
                                <p>{{ $offer->city }}</p>
                            </div>
                            <div class="boxContent">
                                <p>{{ $offer->description }}</p>
                            </div>
                            <div class="boxFooter">
                                <div class="boxLeftSide">
                                    <span>Posté par : <small>{{ $offer->name ? $offer->name : $offer->email }}</small></span>
                                </div>
                                <div class="boxRightSide rightArrow"></div>
                            </div>
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
@endsection