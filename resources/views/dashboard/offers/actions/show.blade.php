@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-10 col-lg-10">
                <a href="{{ route('dashboardIndexOffers') }}" class="btn btn-dark btn-sm" style="margin-bottom: 15px;">Retour à la liste</a>
                <div class="card card-default">
                    <div class="card-header">{{ $offer->title }}
                        @if ($offer->valid == 0)
                            <small><span class="badge badge-danger">Non valide</span></small>
                        @else
                            <small><span class="badge badge-success">Validée</span></small>
                        @endif
                    </div>

                    <div class="card-body" style="overflow-x:scroll;">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <small class="mb-0">
                            <span style="margin-right: 50px;">Type de contrat : @lang('vocabulary.' . $offer->contract_type)</span>
                            <span style="margin-right: 50px;">Durée : {{ $offer->duration }}</span>
                            <span style="margin-right: 50px;">Rémunération : {{ $offer->remuneration }}</span>
                        </small>

                        <hr>

                        <?php $description = $offer->description; ?>
                        <p style="margin: 30px;"><?php echo nl2br($description) ?></p>

                        <small>Mis en ligne par : {{ $offer->company_name ? $offer->company_name : $offer->user_email }}</small>

                        <hr>

                        <div style="display: flex; justify-content: space-around; text-align: center;">
                            <small style="flex-basis: 30%;">Téléphone de l'entreprise : <b>{{ $offer->company_phone }}</b></small>
                            <small style="flex-basis: 30%;">Adresse de l'entreprise : <b>{{ $offer->company_address }}</b></small>
                            <small style="flex-basis: 30%;">Email de l'entreprise : <b>{{ $offer->user_email }}</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
