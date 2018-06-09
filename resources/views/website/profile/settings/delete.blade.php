<!-- Modal -->
<div class="modal fade" id="modalDeleteAccount" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="deleteData" role="form" method="post" action="/settings/delete">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="modalTitle" id="myModalLabel">Supprimer définitivement votre compte</h3>
                </div>
                <!-- Modal Body -->
                <div class="modalBody">
                    <p>Nous vous rappellons que vous ne pourrez ni réactiver votre compte ni récupérer son contenu ou ses informations en cas de suppression définitive. Si vous souhaitez tout de même poursuivre, veuillez saisir votre mot de passe.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="delete_password">Mot de passe *</label>
                                <input type="password" id="create_password" name="delete_password" required="required" placeholder="Mot de passe..." value="{{ old('delete_password') }}"/>
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