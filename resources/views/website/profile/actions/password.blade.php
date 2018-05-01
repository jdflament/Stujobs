<!-- Modal -->
<div class="modal fade" id="modalChangePassword" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="changePassword" role="form" method="post" action="/profile/password/update">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Modifier mon mot de passe</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">

                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="current-password">Veuillez saisir votre mot de passe actuel *</label>
                                <input type="password" id="current_password" name="current_password" required="required" placeholder="Mot de passe actuel..."/>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="new-password">Veuillez saisir votre nouveau mot de passe *</label>
                                <input type="password" id="new_password" name="new_password" required="required" placeholder="Mot de passe..."/>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="new-password-confirm">Veuillez confirmer votre nouveau mot de passe *</label>
                                <input type="password" id="new_password_confirm" name="new_password_confirm" required="required" placeholder="Mot de passe..."/>
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