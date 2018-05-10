<!-- Modal -->
<div class="modal fade" id="modalApply" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form action="/offers/{{ $offer->offer_id }}/apply" name="applyOffer" id="applyOffer" method="POST" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Candidater pour cette offre</h4>
                </div>
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="apply_firstname">Prénom *</label>
                                <input type="text" id="apply_firstname" name="apply_firstname" required="required" placeholder="Ex : John" value="{{ old('apply_firstname') }}">
                                @if ($errors->has('apply_firstname'))
                                    <div class="error">{{ $errors->first('apply_firstname') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="apply_lastname">Nom *</label>
                                <input type="text" id="apply_lastname" name="apply_lastname" required="required" placeholder="Ex : Doe" value="{{ old('apply_lastname') }}">
                                @if ($errors->has('apply_lastname'))
                                    <div class="error">{{ $errors->first('apply_lastname') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="apply_email">Email *</label>
                                <input type="email" id="apply_email" name="apply_email" required="required" placeholder="Ex : johndoe@mail.com" value="{{ old('apply_email') }}">
                                @if ($errors->has('apply_email'))
                                    <div class="error">{{ $errors->first('apply_email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="apply_phone">Téléphone *</label>
                                <input type="number" id="apply_phone" name="apply_phone" required="required" placeholder="Ex : 0601020304" value="{{ old('apply_phone') }}">
                                @if ($errors->has('apply_phone'))
                                    <div class="error">{{ $errors->first('apply_phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="apply_cv">CV</label>
                                <label class="file" title=""><input type="file" id="apply_cv" name="apply_cv" onchange="this.parentNode.setAttribute('title', this.value.replace(/^.*[\\/]/, ''))" /></label>
                                @if ($errors->has('apply_cv'))
                                    <div class="error">{{ $errors->first('apply_cv') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="apply_subject">Sujet *</label>
                                <input type="text" id="apply_subject" name="apply_subject" required="required" placeholder="Ex : Candidature spontanée stage" value="{{ old('apply_subject') }}">
                                @if ($errors->has('apply_subject'))
                                    <div class="error">{{ $errors->first('apply_subject') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="apply_message">Message *</label>
                                <textarea rows="6" id="apply_message" name="apply_message" required="required" placeholder="Madame, Monsieur...">{{ old('apply_message') }}</textarea>
                                @if ($errors->has('apply_message'))
                                    <div class="error">{{ $errors->first('apply_message') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgPrimary submit-btn">Postuler</button>
                </div>

            </form>
        </div>
    </div>
</div>