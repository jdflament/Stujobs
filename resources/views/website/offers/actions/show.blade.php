@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="row">
            <a href="{{ route('home') }}" style="margin-left: 15px;" class="buttonActionLg bgPrimary"><i class="fa fa-arrow-left"></i> Retour à l'accueil</a>
        </div>
    </div>
    @include('website.templates.topbox')

    <div class="containerLg">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-8 marginTop">
                <div class="boxEffect">
                    <h3 class="boxTitleBlack boxTitleLogo">
                        <div class="logoBox smallLogo" style="{{ $offer->company_logo_filename ? 'background-size: contain;' : 'background-size: cover;' }} background-image:url('{{ $offer->company_logo_filename ? asset('storage/logos') . '/' . $offer->company_logo_filename : asset('storage/logos/default-image.png') }}')"></div>
                        À propos de l'offre :  <span class="boxTitle">{{ $offer->title }}</span></h3>
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
                    <p class="paragraphe"><span class="smallText">Secteur : </span> @lang('vocabulary.sector_activity.' . $offer->sector . '.name')</p>
                    <p class="paragraphe"><span class="smallText">Durée : </span> {{ $offer->duration }}</p>
                    <p class="paragraphe"><span class="smallText">Rémunération : </span> {{ $offer->remuneration }}€ / h</p>
                    <p class="paragraphe"><span class="smallText">Posté par : </span> {{ $offer->company_name ? $offer->company_name : $offer->user_email }}</p>
                </div>
                <div style="text-align: center; margin: 30px auto 15px;">
                    <button class="buttonActionLg bgPrimary largeButton" data-toggle="modal" data-target="#modalApply"><i class="fa fa-file-text"></i> Je candidate</button>
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

    @include('website/offers/actions/apply')
@endsection
