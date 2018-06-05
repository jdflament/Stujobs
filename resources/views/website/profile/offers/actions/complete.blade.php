<!-- Modal -->
<div class="modal fade" id="modalCompleteOffer" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modalContent">
            <form action="#" name="completeOffer" id="completeOffer" method="POST">
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Terminer une offre</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <p>Voulez-vous vraiment terminer cette offre ?</p>
                            <p>Après cette action, l'offre sera hors ligne.</p>
                            <p>Pour plus de détails, nous vous invitons à saisir la raison ci-dessous :</p>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="complete_reason">Raison *</label>
                                <textarea rows="4" id="complete_reason" name="complete_reason" required="required" placeholder="Ex : Nous avons trouvé notre candidat...">{{ old('complete_reason') }}</textarea>
                                @if ($errors->has('complete_reason'))
                                    <div class="error">{{ $errors->first('complete_reason') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgSuccess submit-btn">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>