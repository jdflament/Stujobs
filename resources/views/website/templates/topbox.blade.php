<div class="containerLg">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="boxEffect topBox">
                <div class="topBoxContent">
                    <div class="leftSide">
                        <h3>L'IUT de Lens</h3>
                        <p>Vous propose des offres d'emploi exclusives par le biais de plusieurs entreprises. <br />
                            Notre site vous propose actuellement {{ $countOffers }} offre(s) d'emploi au total.</p>
                    </div>
                    <div class="rightSide">
                        <form id='search' method="get" action="/offers/search/result" name="searchOffer">
                            <?php
                                null !== request()->get('searchOffer') ? $term = request()->get('searchOffer') : $term = "";
                            ?>
                            <input id='valsearch' type="text" name="searchOffer" class="searchInput" id="searchOffer" placeholder="Rechercher une offre..." autocomplete="off" value="{{ $term }}" />
                            <button class="inputRightIcon" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>