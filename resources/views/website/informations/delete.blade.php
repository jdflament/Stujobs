<!-- Modal -->
<div class="modal fade" id="modalDeleteAccount" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="deleteData" role="form" method="post" action="/informations/delete">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="modalTitle" id="myModalLabel">Supprimer définitivement mes données</h3>
                </div>
                <!-- Modal Body -->
                <div class="modalBody">
                    <p>Nous vous rappellons que vous ne pourrez pas récupérer vos données en cas de suppression définitive. Si vous souhaitez tout de même poursuivre, veuillez saisir votre adresse email utilisée sur Stujobs pour obtenir votre code de vérification.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="delete_email">Votre adresse email *</label>
                                <input type="email" id="delete_email" name="delete_email" required="required" placeholder="Votre adresse email..." />
                                @if ($errors->has('delete_email'))
                                    <div class="error">{{ $errors->first('delete_email') }}</div>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgDanger submit-btn">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>