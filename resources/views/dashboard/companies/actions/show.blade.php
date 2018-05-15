@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexCompanies') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle boxTitleLogo">
                            Compte entreprise
                        </h3>
                    </div>

                    <div class="boxEffectContent">
                        <p class="paragraphe"><div class="logoBox smallLogo" style="display: inline-block; {{ $company->logo_filename ? 'background-size: contain;' : 'background-size: cover;' }} background-image:url('{{ $company->logo_filename ? asset('storage/logos') . '/' . $company->logo_filename : asset('storage/logos/default-image.png') }}')"></div></p>
                        <p class="paragraphe"><span class="smallText">Email : </span> {{ $company->email }}</p>
                        <p class="paragraphe"><span class="smallText">Rôle : </span> {{ $company->role }}</p>
                        <p class="paragraphe"><span class="smallText">Compte vérifié : </span> {{ $company->verified ? 'Oui' : 'Non' }}</p>
                        <?php
                        $date = new \Carbon\Carbon($company->created_at);
                        $date::setLocale('fr');
                        ?>
                        <p class="paragraphe"><span class="smallText">Membre inscrit : </span> {{ $date->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations complémentaires</h3>
                    </div>

                    <div class="boxEffectContent">
                        <p class="paragraphe"><span class="smallText">Raison sociale : </span> {{ $company->name ? $company->name : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">SIRET : </span> {{ $company->siret ? $company->siret : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Téléphone : </span> {{ $company->phone ? $company->phone : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Adresse : </span> {{ $company->address ? $company->address : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Description : </span> {{ $company->description ? $company->description : 'NC' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
