@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="{{ route('home') }}" class="btn btn-dark btn-sm" style="margin-bottom: 15px; float: right;">Retour à l'accueil</a>

                <h3 style="clear: both; margin-bottom: 30px;">{{ $offer->title }}
                    @if ($offer->valid == 0)
                        <small><span class="badge badge-danger">Non valide</span></small>
                    @else
                        <small><span class="badge badge-success">Validé</span></small>
                    @endif
                </h3>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <small class="mb-0">
                                <span style="margin-right: 50px;">Type de contrat : @lang('vocabulary.' . $offer->contract_type)</span>
                                <span style="margin-right: 50px;">Durée : {{ $offer->duration }}</span>
                                <span style="margin-right: 50px;">Rémunération : {{ $offer->remuneration }}</span>
                            </small>
                        </div>

                        <div class="card-body">
                            <?php $description = $offer->description; ?>
                            <p style="margin: 30px;"><?php echo nl2br($description) ?></p>

                            <hr>

                            <div style="display: flex; justify-content: space-around; text-align: center;">
                                <small style="flex-basis: 30%;">Téléphone de l'entreprise : <b>{{ $offer->company_phone }}</b></small>
                                <small style="flex-basis: 30%;">Adresse de l'entreprise : <b>{{ $offer->company_address }}</b></small>
                                <small style="flex-basis: 30%;">Email de l'entreprise : <b>{{ $offer->user_email }}</b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: center; display: table; margin: 15px auto;">
                    <h5>Partager sur les réseaux</h5>
                    <ul class="socials-buttons" style="display: flex; list-style:none; margin-left: 0px; padding-left: 0px;">
                        <li>
                            <a class="customer share btn btn-social btn-facebook" href="https://www.facebook.com/sharer.php?u={{ urlencode(Request::fullUrl()) }}" title="Facebook share" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <?php $contract_type = __('vocabulary.' . $offer->contract_type) ?>
                        <li>
                            <a class=" customer share btn btn-social btn-twitter" href="https://twitter.com/share?url={{ urlencode(Request::fullUrl()) }}&amp;text={{ $offer->title }} &amp;hashtags={{ str_replace(' ', '', $contract_type) }}" title="Twitter share" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="btn btn-social btn-google-plus" href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" title="Google Plus Share" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>



<hr>

<small>Mis en ligne par : {{ $offer->company_name ? $offer->company_name : $offer->user_email }}</small>
</div>
</div>
</div>
@endsection
