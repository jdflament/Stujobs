@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mes annonces
                    <a href="{{ route('createOfferPage') }}" style="float: right;" class="btn btn-primary btn-sm">
                        Créer une nouvelle annonce
                    </a>
                    </div>

                    <div class="card-body">
                        Annonce 1...
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
