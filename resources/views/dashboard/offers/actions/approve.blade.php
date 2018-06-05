<!-- Modal -->
<div class="modal fade" id="modalApproveOffer" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modalContent">
            <form action="#" name="approveOffer" id="approveOffer" method="POST">
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Approuver une offre</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <p>Voulez-vous vraiment approuver cette offre ?</p>
                            <p>Après cette action, l'offre sera en ligne.</p>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="approve_reason">Raison</label>
                                <textarea rows="4" id="approve_reason" name="approve_reason" placeholder="Ex : L'offre est complète...">{{ old('approve_reason') }}</textarea>
                                @if ($errors->has('approve_reason'))
                                    <div class="error">{{ $errors->first('approve_reason') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgSuccess submit-btn">Approuver</button>
                </div>
            </form>
        </div>
    </div>
</div>