@extends('layouts.dashboard')

@section('content')
    <div class="containerLg">
        <div class="rowActions">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ route('dashboardIndexApplies') }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
                <a href="/dashboard/offers/{{ $apply->offer_id }}/show" class="buttonActionLg bgPrimary"><i class="fa fa-eye"></i> Voir l'offre</a>

                @if ($apply->apply_valid == 0)
                    <div class="applyActions">
                        <button class="buttonActionLg bgDanger btn-pre-refuse-apply" data-href="/dashboard/applies/{{ $apply->apply_id }}/refuse" data-toggle="modal" data-target="#modalRefuseApply"><i class="fa fa-times"></i> Refuser la candidature</button>
                        <button class="buttonActionLg bgSuccess btn-pre-accept-apply" data-href="/dashboard/applies/{{ $apply->apply_id }}/accept" data-toggle="modal" data-target="#modalAcceptApply"><i class="fa fa-envelope"></i> Valider et envoyer la candidature</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">
                            Candidature de <span class="colorPrimary">{{ $apply->apply_firstname }} {{ $apply->apply_lastname }}</span>

                            <div class="applyStatus">
                                @if ($apply->apply_valid == 0)
                                    <span class="badge bgWarning">En attente</span>
                                @elseif ($apply->apply_valid == 1)
                                    <span class="badge bgSuccess">Acceptée</span>
                                @elseif ($apply->apply_valid == 2)
                                    <span class="badge bgDanger">Refusée</span>
                                @endif
                            </div>
                        </h3>
                    </div>

                    <div class="boxEffectContent">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

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
                        <p class="paragraphe showCv">
                            <span class="smallText">CV : </span>
                            @if ($apply->apply_cv_filename)
                                <a href="{{ asset('storage/cv') . '/' . $apply->apply_cv_filename }}" target="_blank" class="buttonActionLg bgPrimary"><i class="fa fa-file-text"></i> Voir le CV</a>
                            @else
                                Non
                            @endif
                        </p>
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
