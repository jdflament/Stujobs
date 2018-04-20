@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexOffers') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur l'offre</h3>
                    </div>
                    <div class="boxEffectContent">
                        <p class="paragraphe"><span class="smallText">Lieu : </span> {{ $offer->city }}</p>
                        <p class="paragraphe"><span class="smallText">Type de contrat : </span> <span class="@lang('vocabulary.contract_type_colors.' . $offer->contract_type)">@lang('vocabulary.contract_type.' . $offer->contract_type)</span></p>
                        <p class="paragraphe"><span class="smallText">Durée : </span> {{ $offer->duration }}</p>
                        <p class="paragraphe"><span class="smallText">Rémunération : </span> {{ $offer->remuneration }}€ / h</p>
                        <p class="paragraphe"><span class="smallText">Email de l'offre : </span> {{ $offer->contact_email }}</p>
                        <p class="paragraphe"><span class="smallText">Tél de l'offre : </span> {{ $offer->contact_phone }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur l'entreprise</h3>
                    </div>
                    <div class="boxEffectContent">
                        <p class="paragraphe"><span class="smallText">Posté par : </span> {{ $offer->company_name ? $offer->company_name : $offer->user_email }}</p>
                        <?php
                        $date = new \Carbon\Carbon($offer->user_created_at);
                        $date::setLocale('fr');
                        ?>
                        <p class="paragraphe"><span class="smallText">Inscription : </span> {{ $date->diffForHumans() }}</p>
                        <p class="paragraphe"><span class="smallText">Email de la société : </span> {{ $offer->user_email }}</p>
                        <p class="paragraphe"><span class="smallText">SIRET : </span> {{ $offer->company_siret ? $offer->company_siret : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Tél : </span> {{ $offer->company_phone ? $offer->company_phone : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Adresse : </span> {{ $offer->company_address ? $offer->company_address : 'NC' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">
                            À propos de l'offre :  <span class="colorPrimary">{{ $offer->title }}</span>

                            @if ($offer->complete == 0)
                                <span class="infoBoxEffectHeader badge bgWarning">En cours</span>
                            @else
                                <span class="infoBoxEffectHeader badge bgInfo">Terminée</span>
                            @endif

                            @if ($offer->valid == 0)
                                <span class="infoBoxEffectHeader badge bgDanger">Non validée</span>
                            @else
                                <span class="infoBoxEffectHeader badge bgSuccess">Validée</span>
                            @endif
                        </h3>
                    </div>
                    <div class="boxEffectContent">
                        <?php $description = $offer->description; ?>
                        <p class="paragraphe"><?php echo nl2br($description) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
