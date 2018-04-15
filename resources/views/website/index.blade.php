@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center; margin-bottom: 30px">Bienvenue sur le site Stujobs, il y a {{ count($offers) }} offre(s) d'emploi en ligne.</h5>

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