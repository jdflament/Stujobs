@foreach ($offers as $offer)
    <a class="boxEffect boxOffer" href="/offers/{{ $offer->id_offer }}">
        <div class="boxHeader">
            <h3 class="boxTitle">{{ $offer->title }}</h3>
            <span class="boxLabel @lang('vocabulary.contract_type_bgcolors.' . $offer->contract_type)">@lang('vocabulary.contract_type.' . $offer->contract_type)</span>
            <?php
            $date = new \Carbon\Carbon($offer->created_at);
            $date::setLocale('fr');
            ?>
            <span class="boxDate">{{ $date->diffForHumans() }}</span>
        </div>
        <div class="boxSubtitle">
            <p>{{ $offer->city }}</p>
        </div>
        <div class="boxContent">
            <p>{{ $offer->description }}</p>
        </div>
        <div class="boxFooter">
            <div class="boxLeftSide">
                <span>Posté par : <small>{{ $offer->name ? $offer->name : $offer->email }}</small></span>
                <span>Secteur : <small>@lang('vocabulary.sector_activity.' . $offer->sector . '.name')</small></span>
            </div>
            <div class="boxRightSide rightArrow"></div>
        </div>
    </a>
@endforeach
