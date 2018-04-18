@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-xs-12">
                <div class="card">
                    <div class="card-header">Liste des offres
                        <!-- Button trigger modal -->
                        <a href="{{ route('dashboardCreateOfferPage') }}" style="float: right;" class="btn btn-primary btn-sm">
                            Ajouter une offre
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row justify-content-end">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" id="filterOffers">
                                        <?php $offersType = \Illuminate\Support\Facades\Lang::get('vocabulary.offers_type'); ?>
                                        @foreach($offersType as $key => $offerType)
                                            <option value="{{ $key }}">{{ $offerType }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
