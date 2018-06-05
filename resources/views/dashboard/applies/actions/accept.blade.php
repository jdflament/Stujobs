<!-- Modal -->
<div class="modal fade" id="modalAcceptApply" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modalContent">
            <form action="#" name="acceptApply" id="acceptApply" method="POST">
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Accepter et envoyer cette candidature</h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <p>Voulez-vous vraiment accepter et envoyer cette candidature à l'entreprise (<strong>{{ $apply->offer_contact_email }}</strong>) ?</p>
                            <p>Après cette action, l'entreprise ayant proposé cette offre recevra par email la candidature.</p>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="accept_reason">Raison</label>
                                <textarea rows="4" id="accept_reason" name="accept_reason" placeholder="Ex : La candidature correspond à l'offre...">{{ old('accept_reason') }}</textarea>
                                @if ($errors->has('accept_reason'))
                                    <div class="error">{{ $errors->first('accept_reason') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgSuccess submit-btn">Accepter et envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>