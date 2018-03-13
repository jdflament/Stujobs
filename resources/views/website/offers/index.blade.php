@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Mes annonces
                    <a href="{{ route('createOfferPage') }}" style="float: right;" class="btn btn-primary btn-sm">
                        Créer une nouvelle annonce
                    </a>
                    </div>

                    <div class="card-body">
                        @include('website/offers/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
