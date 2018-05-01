@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('indexOffers') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
                @if ($offer->complete == 0)
                    <div class="offerActions">
                        <button data-href="/profile/offers/{{ $offer->offer_id }}/complete" data-offerid="{{ $offer->offer_id }}" class="buttonActionLg bgSuccess btn-pre-complete-offer" data-toggle="modal" data-target="#modalCompleteOffer">
                            <i style="color: white;" class="fa fa-check"></i> Terminer l'offre
                        </button>
                    </div>
                @else
                    <div class="offerActions">
                        <button data-href="/profile/offers/{{ $offer->offer_id }}/uncomplete" data-offerid="{{ $offer->offer_id }}" class="buttonActionLg bgWarning btn-pre-uncomplete-offer" data-toggle="modal" data-target="#modalUncompleteOffer">
                            <i style="color: white;" class="fa fa-refresh"></i> Ré-activer l'offre
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">
                            À propos de votre offre :  <span class="colorPrimary">{{ $offer->title }}</span>

                            <div class="offerStatus">
                                @if ($offer->valid == 1)
                                    <span class="badge bgSuccess">Validée</span>
                                @else
                                    <span class="badge bgDanger">Non-validée</span>
                                @endif
                                <span class="completeStatus">
                                    @if ($offer->complete == 0)
                                        <span class="badge bgWarning">En cours</span>
                                    @else
                                        <span class="badge bgInfo">Clôturée</span>
                                    @endif
                                </span>
                            </div>
                        </h3>
                    </div>
                    <div class="boxEffectContent">
                        <?php $description = $offer->description; ?>
                        <p class="paragraphe"><?php echo nl2br($description) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4">
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
        </div>
    </div>

    @include('website/profile/offers/actions/complete')
    @include('website/profile/offers/actions/uncomplete')
@endsection
