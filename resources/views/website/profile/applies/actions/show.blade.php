@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('indexApplies') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
                <a href="/profile/offers/{{ $apply->offer_id }}/show" class="buttonActionLg bgPrimary"><i class="fa fa-eye"></i> Voir l'offre</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">
                            Candidature de <span class="colorPrimary">{{ $apply->apply_firstname }} {{ $apply->apply_lastname }}</span>
                        </h3>
                    </div>

                    <div class="boxEffectContent">
                        <h5 class="boxEffectSubtitle">Sujet : {{ $apply->apply_subject }}</h5>

                        <?php $message = $apply->apply_message; ?>
                        <p><?php echo nl2br($message) ?></p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 col-lg-4">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur le candidat</h3>
                    </div>
                    <div class="boxEffectContent">
                        <p class="paragraphe"><span class="smallText">Prénom : </span> {{ $apply->apply_firstname }}</p>
                        <p class="paragraphe"><span class="smallText">Nom : </span> {{ $apply->apply_lastname }}</p>
                        <p class="paragraphe"><span class="smallText">Email : </span> {{ $apply->apply_email }}</p>
                        <p class="paragraphe"><span class="smallText">Tél : </span> {{ $apply->apply_phone }}</p>
                    </div>
                </div>

                <div class="boxEffect" style="margin-top: 30px;">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur l'offre</h3>
                    </div>
                    <div class="boxEffectContent">
                        <p class="paragraphe"><span class="smallText">Posté par : </span> {{ $apply->company_name ? $apply->company_name : $apply->company_email }}</p>
                        <p class="paragraphe"><span class="smallText">Titre : </span> {{ $apply->offer_title }}</p>
                        <p class="paragraphe"><span class="smallText">Type de contrat : </span> @lang('vocabulary.contract_type.' . $apply->offer_contract_type)</p>
                        <p class="paragraphe"><span class="smallText">Durée : </span> {{ $apply->offer_duration }}</p>
                        <p class="paragraphe"><span class="smallText">Rémunération : </span> {{ $apply->offer_remuneration }}€ / h</p>
                        <p class="paragraphe"><span class="smallText">Email de contact : </span> <strong>{{ $apply->offer_contact_email }}</strong></p>
                        <p class="paragraphe"><span class="smallText">Tél de contact : </span> {{ $apply->offer_contact_phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/applies/actions/accept')
    @include('dashboard/applies/actions/refuse')
@endsection
