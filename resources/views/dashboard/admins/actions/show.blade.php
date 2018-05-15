@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexAdmins') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Compte administrateur</h3>
                    </div>
                    <div class="boxEffectContent">
                        <p class="paragraphe"><span class="smallText">Email : </span> {{ $admin->email }}</p>
                        <p class="paragraphe"><span class="smallText">Rôle : </span> {{ $admin->role }}</p>
                        <p class="paragraphe"><span class="smallText">Compte vérifié : </span> {{ $admin->verified ? 'Oui' : 'Non' }}</p>
                        <?php
                        $date = new \Carbon\Carbon($admin->created_at);
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
                        <p class="paragraphe"><span class="smallText">Nom : </span> {{ $admin->firstname ? $admin->firstname : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Prénom : </span> {{ $admin->lastname ? $admin->lastname : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Téléphone : </span> {{ $admin->phone ? $admin->phone : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Poste : </span> {{ $admin->office ? $admin->office : 'NC' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
