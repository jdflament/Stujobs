@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mes offres d'emploi
                    <a href="{{ route('createOfferPage') }}" style="float: right;" class="btn btn-primary btn-sm">
                        Créer une nouvelle offre
                    </a>
                    </div>

                    <div class="card-body">
                        @include('website/profile/offers/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('website/profile/offers/actions/complete')
    @include('website/profile/offers/actions/uncomplete')
@endsection
