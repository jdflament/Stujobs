<!-- Modal -->
<div class="modal fade" id="modalEditAdmin" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="editAdmin" role="form" method="post" action="#">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Modifier un administrateur</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="edit_email">Email de l'administrateur *</label>
                                <input type="text" id="edit_email" name="edit_email" required="required" placeholder="Ex : admin@mail.com"/>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="edit_role">Rôle *</label>
                                <div class="formSelect">
                                    <select id="edit_role" name="edit_role" required="required">
                                        <option disabled selected value="">Sélectionner un rôle</option>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Administrateur</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_firstname">Prénom</label>
                                <input type="text" id="edit_firstname" name="edit_firstname" placeholder="Ex : John" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_lastname">Nom</label>
                                <input type="text" id="edit_lastname" name="edit_lastname" placeholder="Ex : Doe" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_phone">Téléphone</label>
                                <input type="text" id="edit_phone" name="edit_phone" placeholder="Ex : 0601020304" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_office">Fonction</label>
                                <input type="text" id="edit_office" name="edit_office" placeholder="Ex : Informaticien" />
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgPrimary submit-btn">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>