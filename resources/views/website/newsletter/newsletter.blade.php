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
                    <h3 class="modalTitle" id="myModalLabel">S'inscrire à notre newsletter</h3>
                </div>
                <!-- Modal Body -->
                <div class="modalBody">
                    {{-- <h3 class="modalTitle">S'inscrire à notre newsletter</h3>--}}
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="newsletter_email">Votre adresse email</label>
                                <input type="text" id="newsletter_email" name="newsletter_email" required="required"  placeholder="Ex : thomas.laigneau@mail.com" value="{{ old('newsletter_email') }}" />
                            </div>
                        </div>
                    </div>
                    <h3 class="modalTitle">Choissisez un secteur d'activité (optionnel)</h3>                    
                    <div class="row">
                        <ul class="listNewsletter">
                            <li><input type="checkbox" name="newsletter_sectors[]" class="checkboxInput" checked="checked" value="all"><span class="checkboxSpan">Tous</span></li>
                            <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.sector_activity'); ?>
                            @foreach($sectors as $key => $sector)
                                <li><input type="checkbox" name="newsletter_sectors[]" class="checkboxInput" value="{{ $key }}"><span class="checkboxSpan">{{ $sector }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <h3 class="modalTitle">Choissisez un type de contrat (optionnel)</h3>                    
                    <div class="row">
                        <ul class="listNewsletter">
                            <li><input type="checkbox" name="newsletter_contract_type[]" class="checkboxInput" checked="checked" value="all"><span class="checkboxSpan">Tous</span></li>
                            <?php $sectors = \Illuminate\Support\Facades\Lang::get('vocabulary.contract_type'); ?>
                            @foreach($sectors as $key => $sector)
                                <li><input type="checkbox" name="newsletter_contract_type[]" class="checkboxInput" value="{{ $key }}"><span class="checkboxSpan">{{ $sector }}</span></li>
                            @endforeach
                        </ul>
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