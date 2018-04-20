@extends('layouts.website')

@section('content')
    <!-- <a href="{{ route('home') }}" class="btn btn-dark btn-sm" style="margin-bottom: 15px; float: right;">Retour à l'accueil</a> -->
    @include('website.templates.topbox')
    
    <div class="containerLg">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-8 marginTop">
                <div class="boxEffect">
                    <h3 class="boxTitleBlack">À propos de l'offre :  <span class="boxTitle">{{ $offer->title }}</span></h3>
                    <br />
                    <?php $description = $offer->description; ?>
                    <p class="paragraphe"><?php echo nl2br($description) ?></p>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4 marginTop">
                <div class="boxEffect informationsBox">
                    <h3 class="boxTitle centerContent">Informations</h3>
                    <p class="paragraphe"><span class="smallText">Lieu : </span> {{ $offer->city }}</p>                    
                    <p class="paragraphe"><span class="smallText">Type de contrat : </span> <span class="@lang('vocabulary.contract_type_colors.' . $offer->contract_type)">@lang('vocabulary.contract_type.' . $offer->contract_type)</span></p>
                    <p class="paragraphe"><span class="smallText">Durée : </span> {{ $offer->duration }}</p>
                    <p class="paragraphe"><span class="smallText">Rémunération : </span> {{ $offer->remuneration }}€ / h</p>
                    <p class="paragraphe"><span class="smallText">Posté par : </span> {{ $offer->company_name ? $offer->company_name : $offer->user_email }}</p>
                </div>
                <div style="text-align: center; display: table; margin: 15px auto;">
                    <h3 class="boxTitle">Partager sur les réseaux</h3>
                    <ul class="socials-buttons" style="display: flex; list-style:none; margin-left: 0px; padding-left: 0px;">
                        <li>
                            <a class="customer share btn btn-social btn-facebook" href="https://www.facebook.com/sharer.php?u={{ urlencode(Request::fullUrl()) }}" title="Facebook share" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <?php $contract_type = __('vocabulary.contract_type.' . $offer->contract_type) ?>
                        <li>
                            <a class=" customer share btn btn-social btn-twitter" href="https://twitter.com/share?url={{ urlencode(Request::fullUrl()) }}&amp;text={{ $offer->title }} &amp;hashtags={{ str_replace(' ', '', $contract_type) }}" title="Twitter share" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="btn btn-social btn-google-plus" href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" title="Google Plus Share" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="containerLg">
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
@endsection
