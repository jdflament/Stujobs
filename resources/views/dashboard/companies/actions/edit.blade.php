<!-- Modal -->
<div class="modal fade" id="modalEditCompany" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="editCompany" role="form" method="post" action="#">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Modifier une entreprise</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="edit_email">Email de l'entreprise *</label>
                                <input type="text" id="edit_email" name="edit_email" required="required" placeholder="Ex : company@mail.com"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="edit_role">Rôle *</label>
                                <div class="formSelect">
                                    <select id="edit_role" name="edit_role" required="required">
                                        <option disabled selected value="">Sélectionner un rôle</option>
                                        <option value="company">Entreprise</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_name">Nom de l'entreprise</label>
                                <input type="text" id="edit_name" name="edit_name" placeholder="My Company" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_siret">SIRET</label>
                                <input type="text" id="edit_siret" name="edit_siret" placeholder="Ex : 362 521 879 00034" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_address">Adresse</label>
                                <input type="text" id="edit_address" name="edit_address" placeholder="Ex : 15 rue Victor Hugo" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="edit_phone">Téléphone</label>
                                <input type="text" id="edit_phone" name="edit_phone" placeholder="Ex : 0301020304" />
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