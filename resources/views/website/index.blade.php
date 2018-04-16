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
                        <label>Types de contrat</label>
                        <ul>
                            <li><input type="checkbox" name="contract[][all]" class="checkboxInput"><span class="checkboxSpan">Tous</span></li>
                            <li><input type="checkbox" name="contract[][interim]" class="checkboxInput"><span class="checkboxSpan">Intérim</span></li>
                            <li><input type="checkbox" name="contract[][sj]" class="checkboxInput"><span class="checkboxSpan">Job Étudiant</span></li>
                            <li><input type="checkbox" name="contract[][stage]" class="checkboxInput"><span class="checkboxSpan">Stage</span></li>
                            <li><input type="checkbox" name="contract[][ca]" class="checkboxInput"><span class="checkboxSpan">Contrat d'apprentissage</span></li>
                            <li><input type="checkbox" name="contract[][cp]" class="checkboxInput"><span class="checkboxSpan">Contrat de professionnalisation</span></li>
                            <li><input type="checkbox" name="contract[][cdd]" class="checkboxInput"><span class="checkboxSpan">CDD</span></li>
                            <li><input type="checkbox" name="contract[][cdi]" class="checkboxInput"><span class="checkboxSpan">CDI</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 col-lg-8">
            @if (count($offers) > 0)
                <div class="card-deck">
                    @foreach ($offers as $offer)
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $offer->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Contrat : @lang('vocabulary.' . $offer->contract_type)</h6>
                                <hr>
                                <p class="card-text">{{ $offer->description }}</p>
                                <hr>
                                <p class="card-text"><small class="text-muted">Posté par : {{ $offer->name ? $offer->name : $offer->email }} le {{ $offer->created_at }}</small></p>
                                <a href="/offers/{{ $offer->id_offer }}" class="card-link">Voir plus</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        Il n'y a aucune offre d'emploi en ligne, inscrivez vous à la newsletter si vous souhaitez être notifié lors d'une nouvelle annonce.
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
@endsection