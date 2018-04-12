@extends('layouts.dashboard')

@section('content')
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-10 col-lg-10">

                <a href="{{ route('dashboardIndexApplies') }}" class="btn btn-dark btn-sm" style="margin-bottom: 15px;">Retour à la liste</a>
                @if ($apply->apply_valid == 0)
                <div class="applyActions" style="margin-bottom: 15px; float: right">
                    <button class="btn btn-danger btn-sm btn-pre-refuse-apply" data-href="/dashboard/applies/{{ $apply->apply_id }}/refuse" data-toggle="modal" data-target="#modalRefuseApply" style="margin-right: 10px;"><i class="fa fa-times"></i> Refuser la candidature</button>
                    <button class="btn btn-success btn-sm btn-pre-accept-apply" data-href="/dashboard/applies/{{ $apply->apply_id }}/accept" data-toggle="modal" data-target="#modalAcceptApply"><i class="fa fa-envelope"></i> Valider et envoyer la candidature</button>
                </div>
                @endif

                <div class="card card-default">
                    <div class="card-header">Candidat : {{ $apply->apply_firstname }} {{ $apply->apply_lastname }}
                        <div class="applyStatus" style="float:right;">
                            @if ($apply->apply_valid == 0)
                                <span class="badge badge-info">En attente</span>
                            @elseif ($apply->apply_valid == 1)
                                <span class="badge badge-success">Acceptée</span>
                            @elseif ($apply->apply_valid == 2)
                                <span class="badge badge-danger">Refusée</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body" style="overflow-x:scroll;">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <small class="mb-0">
                            @if ($apply->apply_cv_filename)<span class="showCv" style="margin-right: 50px;"><a href="{{ asset('storage/cv') . '/' . $apply->apply_cv_filename }}" target="_blank" class="btn btn-primary">Voir le CV</a></span> @endif
                            <span style="margin-right: 50px;">Email du candidat : {{ $apply->apply_email }}</span>
                            <span style="margin-right: 50px;">Téléphone du candidat : {{ $apply->apply_phone }}</span>
                        </small>

                        <hr>

                        <h5 style="margin-left: 30px;">Sujet : {{ $apply->apply_subject }}</h5>

                        <?php $message = $apply->apply_message; ?>
                        <p style="margin: 30px;">" <?php echo nl2br($message) ?> "</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin: 25px 0">
            <h3>Pour l'annonce suivante</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-10 col-lg-10">
                <div class="card card-default">
                    <div class="card-header">{{ $apply->offer_title }}
                    </div>

                    <div class="card-body" style="overflow-x:scroll;">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <small class="mb-0">
                            <span style="margin-right: 50px;">Type de contrat : @lang('vocabulary.' . $apply->offer_contract_type)</span>
                            <span style="margin-right: 50px;">Durée : {{ $apply->offer_duration }}</span>
                            <span style="margin-right: 50px;">Rémunération : {{ $apply->offer_remuneration }}</span>
                        </small>

                        <hr>

                        <?php $description = $apply->offer_description; ?>
                        <p style="margin: 30px;"><?php echo nl2br($description) ?></p>

                        <small>Mis en ligne par : {{ $apply->company_name ? $apply->company_name : $apply->company_email }}</small>

                        <hr>

                        <div style="display: flex; justify-content: space-around; text-align: center;">
                            <small style="flex-basis: 30%;">Téléphone de l'entreprise : <b>{{ $apply->company_phone }}</b></small>
                            <small style="flex-basis: 30%;">Adresse de l'entreprise : <b>{{ $apply->company_address }}</b></small>
                            <small style="flex-basis: 30%;">Email de l'entreprise : <b>{{ $apply->company_email }}</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/applies/actions/accept')
    @include('dashboard/applies/actions/refuse')
@endsection
