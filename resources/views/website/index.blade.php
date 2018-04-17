@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect topBox">
                    <div class="topBoxContent">
                        <div class="leftSide">
                        <h3>L'IUT de Lens</h3>
                            <p>Vous propose des offres d'emploi exclusives par le biais de plusieurs entreprises. <br />
                            Notre site vous propose actuellement {{ count($offers) }} offre(s) d'emploi au total.</p>
                        </div>
                        <div class="rightSide">
                            <input type="text" name="searchOffer" class="searchInput" id="searchOffer" placeholder="Rechercher une offre..." />
                            <div class="inputRightIcon">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <ul>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" checked="checked" value="all"><span class="checkboxSpan">Tous</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="nc"><span class="checkboxSpan">Non précisé</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="interim"><span class="checkboxSpan">Intérim</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="sj"><span class="checkboxSpan">Job Étudiant</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="stage"><span class="checkboxSpan">Stage</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="ca"><span class="checkboxSpan">Contrat d'apprentissage</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="cp"><span class="checkboxSpan">Contrat de professionnalisation</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="cdd"><span class="checkboxSpan">CDD</span></li>
                                <li><input type="checkbox" name="contract_type[]" class="checkboxInput" value="cdi"><span class="checkboxSpan">CDI</span></li>
                            </ul>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                <span class="boxLabel">@lang('vocabulary.' . $offer->contract_type)</span>
                                <?php
                                    $date = new \Carbon\Carbon($offer->created_at);
                                    $date::setLocale('fr');
                                ?>
                                <span class="boxDate">{{ $date->diffForHumans() }}</span>
                            </div>
                            <div class="boxSubtitle">
                                <p>Villeneuve d'Ascq</p>
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