@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('profileSettings') }}" class="buttonActionLg bgDark"><i class="fa fa-cog"></i> Paramètres de confidentialité</a>
                <a href="{{ route('editProfilePage') }}" class="buttonActionLg bgPrimary"><i class="fa fa-pencil"></i> Modifier mes informations</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Mon profil</h3>
                    </div>

                    <div class="boxEffectContent">
                        @include('website/profile/actions/list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
