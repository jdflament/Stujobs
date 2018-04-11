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

                <div class="container">
                    <div class="row justify-content-center m-3">
                        <button class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#collapseApplyForm" aria-expanded="true" aria-controls="collapseApplyForm">Je candidate</button>
                    </div>
                    <div class="row justify-content-center collapse" id="collapseApplyForm">
                        <div class="card col-md-8" style="margin: 0 auto;">
                            <div class="card-body">
                                <form action="/offers/{{ $offer->offer_id }}/apply" name="applyOffer" method="POST" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="apply_firstname">Prénom</label>*
                                            <input type="text" class="form-control" id="apply_firstname" name="apply_firstname" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="apply_lastname">Nom</label>*
                                            <input type="text" class="form-control" id="apply_lastname" name="apply_lastname" required="required">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="apply_email">Email</label>*
                                            <input type="email" class="form-control" id="apply_email" name="apply_email" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="apply_phone">Téléphone</label>*
                                            <input type="number" class="form-control" id="apply_phone" name="apply_phone" required="required">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="apply_cv">CV</label>
                                            <input type="file" class="form-control" id="apply_cv" name="apply_cv">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="apply_subject">Sujet</label>*
                                            <input type="text" class="form-control" id="apply_subject" name="apply_subject" required="required">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="apply_message">Message</label>*
                                            <textarea rows="6" class="form-control" id="apply_message" name="apply_message" required="required"></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-dark">Postuler</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

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

                <small>Mis en ligne par : {{ $offer->company_name ? $offer->company_name : $offer->user_email }}</small>
            </div>
        </div>
    </div>
@endsection
