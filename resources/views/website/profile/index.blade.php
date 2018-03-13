@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mon profil
                        <a href="{{ route('indexOffers') }}" style="float: right;" class="btn btn-primary btn-sm">
                            Voir mes annonces
                        </a>
                    </div>

                    <div class="card-body">
                        Voici mes informations, je peux également les éditer ici...
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
