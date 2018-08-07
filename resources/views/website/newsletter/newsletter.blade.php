<!-- Modal -->
<div class="modal fade" id="modalNewsletter" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="newsletterRegister" role="form" method="post" action="/newsletter/email">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="modalTitle" id="myModalLabel">S'inscrire à notre système d'alerte</h3>
                </div>
                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row filters">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="newsletter_email">Votre adresse email</label>
                                <input type="text" id="newsletter_email" name="newsletter_email" required="required"  placeholder="Ex : thomas.laigneau@mail.com" value="{{ old('newsletter_email') }}" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <label class="labelInput">Choisissez un ou plusieurs secteur d'activité (optionnel)</label>
                            <button class="collapseButton" type="button" data-toggle="collapse" data-target="#collapseNewsletterSectors" aria-expanded="false" aria-controls="collapseNewsletterSectors">Voir les secteurs d'activité <i class="fa fa-chevron-right"></i></button>
                            <ul id="collapseNewsletterSectors" class="listNewsletter collapse">
                                <li><input type="checkbox" name="newsletter_sectors[]" class="checkboxInput checkboxNewsletterSector" checked="checked" value="all"><span class="checkboxSpan">Tous</span></li>
                                <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                                @foreach($sectors as $key => $sector)
                                    @if ($sector['display'] == 1)
                                        <li><input type="checkbox" name="newsletter_sectors[]" class="checkboxInput checkboxNewsletterSector" value="{{ $key }}"><span class="checkboxSpan">{{ $sector['name'] }}</span></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <label class="labelInput">Choisissez un ou plusieurs type de contrat (optionnel)</label>
                            <button class="collapseButton" type="button" data-toggle="collapse" data-target="#collapseNewsletterContractTypes" aria-expanded="false" aria-controls="collapseNewsletterContractTypes">Voir les types de contrat <i class="fa fa-chevron-right"></i></button>
                            <ul id="collapseNewsletterContractTypes" class="listNewsletter collapse">
                                <li><input type="checkbox" name="newsletter_contract_type[]" class="checkboxInput checkboxNewsletterContract" checked="checked" value="all"><span class="checkboxSpan">Tous</span></li>
                                <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.contract_type'); ?>
                                @foreach($sectors as $key => $sector)
                                    <li><input type="checkbox" name="newsletter_contract_type[]" class="checkboxInput checkboxNewsletterContract" value="{{ $key }}"><span class="checkboxSpan">{{ $sector }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup checkboxGroup">
                                <input type="checkbox" name="newsletter_terms" id="newsletter_terms" class="checkboxInput">
                                <label for="newsletter_terms">En vous inscrivant à notre système d'alerte, vous acceptez de recevoir des emails de la part de Stujobs</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgPrimary submit-btn">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>