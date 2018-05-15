@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('createOfferPage') }}" class="buttonActionLg bgPrimary">
                    <i class="fa fa-plus"></i> Créer une nouvelle offre
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Mes offres d'emploi</h3>
                    </div>

                    <div class="boxEffectContent">
                        @include('website/profile/offers/actions/list')
                    </div>

                    <div class="boxEffectFooter paginationBlock">
                        {{ $offers->links('dashboard/templates/pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('website/profile/offers/actions/delete')
@endsection
