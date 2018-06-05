<!-- Modal -->
<div class="modal fade" id="modalUncompleteOffer" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modalContent">
            <form action="#" name="uncompleteOffer" id="uncompleteOffer" method="POST">
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Ré-activer une offre</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <p>Voulez-vous vraiment ré-activer cette offre ?</p>
                            <p>Après cette action, l'offre sera de nouveau en attente de modération.</p>
                            <p>Pour plus de détails, nous vous invitons à saisir la raison ci-dessous :</p>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="uncomplete_reason">Raison *</label>
                                <textarea rows="4" id="uncomplete_reason" name="uncomplete_reason" required="required" placeholder="Ex : Relancement de la campagne de recrutement...">{{ old('uncomplete_reason') }}</textarea>
                                @if ($errors->has('uncomplete_reason'))
                                    <div class="error">{{ $errors->first('uncomplete_reason') }}</div>
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