@extends('layouts.website')

@section('content')
    <div class="containerLg">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <a href="{{ URL::previous() }}" class="buttonActionLg bgDefault"><i class="fa fa-arrow-left"></i> Retour</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle boxTitleLogo">
                            <div class="logoBox smallLogo" style="{{ $company->logo_filename ? 'background-size: contain;' : 'background-size: cover;' }} background-image:url('{{ $company->logo_filename ? asset('storage/logos') . '/' . $company->logo_filename : asset('storage/logos/default-image.png') }}')"></div>
                            <span class="colorPrimary">{{ $company->name }}</span>
                        </h3>
                    </div>

                    <div class="boxEffectContent">
                        <?php
                            $date = new \Carbon\Carbon($company->created_at);
                            $date::setLocale('fr');
                        ?>
                        <h5 class="boxEffectSubtitle">Membre inscrit {{ $date->diffForHumans() }}</h5>

                        <?php $description = $company->description; ?>
                        <p><?php echo nl2br($description) ?></p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 col-lg-4">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Informations sur l'entreprise</h3>
                    </div>
                    <div class="boxEffectContent">
                        <p class="paragraphe"><span class="smallText">Email : </span> {{ $company->email }}</p>
                        <p class="paragraphe"><span class="smallText">SIRET : </span> {{ $company->siret ? $company->siret : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Adresse : </span> {{ $company->address ? $company->address : 'NC' }}</p>
                        <p class="paragraphe"><span class="smallText">Tél : </span> {{ $company->phone ? $company->phone : 'NC' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: 30px">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="boxEffect">
                    <div class="boxEffectHeader">
                        <h3 class="boxEffectTitle">Offres en cours de l'entreprise</h3>
                    </div>
                    <div class="boxEffectContent">
                        <div class="listGroup">
                            @if (count($offers) > 0)
                                @foreach ($offers as $offer)
                                    <a class="listItem" href="/offers/{{ $offer->id }}">
                                        <span class="listTitle">{{ $offer->title }}</span>
                                        <?php
                                            $offer_date = new \Carbon\Carbon($offer->created_at);
                                            $offer_date::setLocale('fr');
                                        ?>
                                        <span class="listSubtitle">posté <span class="colorDark">{{ $offer_date->diffForHumans() }}</span></span>
                                        <span class="listLabel @lang('vocabulary.contract_type_bgcolors.' . $offer->contract_type)">@lang('vocabulary.contract_type.' . $offer->contract_type)</span>
                                        <?php
                                        $date = new \Carbon\Carbon($offer->created_at);
                                        $date::setLocale('fr');
                                        ?>
                                        <span class="listDate">{{ $date->diffForHumans() }}</span>
                                    </a>
                                @endforeach
                            @else
                                <div class="emptyList">
                                    <p>L'entreprise n'a aucune offre en cours.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="boxEffectFooter paginationBlock">
                        {{ $offers->links('website/templates/pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
