@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <!-- Button trigger modal -->
                <a href="{{ route('dashboardCreateOfferPage') }}" class="buttonActionLg bgPrimary">
                    <i class="fa fa-plus"></i> Ajouter une offre
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Liste des offres</h3>
                    </div>

                    <div class="boxEffectContent">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="rowActions">
                            <div class="formSelect">
                                <select class="selectInput" id="filterOffers">
                                    <?php $offersType = \Illuminate\Support\Facades\Lang::get('vocabulary.offers_type'); ?>
                                    @foreach($offersType as $key => $offerType)
                                        <option value="{{ $key }}">{{ $offerType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @include('dashboard/offers/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/offers/actions/approve')
    @include('dashboard/offers/actions/disapprove')
    @include('dashboard/offers/actions/delete')
@endsection
