<!-- Modal -->
<div class="modal fade" id="modalRefuseApply" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modalContent">
            <form action="#" name="refuseApply" id="refuseApply" method="POST">
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Refuser cette candidature</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <p>Voulez-vous vraiment refuser cette candidature ?</p>
                            <p>Après cette action, la candidature ne sera pas envoyée à l'entreprise.</p>
                            <p>Pour plus de détails, nous vous invitons à saisir la raison ci-dessous :</p>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="refuse_reason">Raison *</label>
                                <textarea rows="4" id="refuse_reason" name="refuse_reason" required="required" placeholder="Ex : Le candidat n'est pas de l'école...">{{ old('refuse_reason') }}</textarea>
                                @if ($errors->has('refuse_reason'))
                                    <div class="error">{{ $errors->first('refuse_reason') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgDanger submit-btn">Refuser</button>
                </div>
            </form>
        </div>
    </div>
</div>