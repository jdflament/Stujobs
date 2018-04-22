@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardEditProfilePage') }}" class="buttonActionLg bgPrimary">
                    <i class="fa fa-pencil"></i> Modifier mes informations
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Mon profil</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('dashboard/profile/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection