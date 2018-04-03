<!-- Modal -->
<div class="modal fade" id="modalCreateAdmin" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="createAdmin" role="form" method="post" action="/dashboard/admins">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter un nouvel administrateur</h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_email">Email de l'administrateur</label>*
                                <input type="text" class="form-control" id="create_email" name="create_email" required="required"  placeholder="Ex : admin@mail.com"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_password">Mot de passe</label>*
                                <input type="password" class="form-control" id="create_password" name="create_password" required="required" placeholder="Mot de passe..."/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_role">Rôle</label>*
                                <select class="form-control" id="create_role" name="create_role" required="required">
                                    <option disabled selected value="">Sélectionner un rôle</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <p style="text-align:center;">Les informations suivantes ne sont pas obligatoire</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_firstname">Prénom</label>
                                <input type="text" class="form-control" id="create_firstname" name="create_firstname" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_lastname">Nom</label>
                                <input type="text" class="form-control" id="create_lastname" name="create_lastname" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_phone">Téléphone</label>
                                <input type="text" class="form-control" id="create_phone" name="create_phone" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="create_office">Fonction</label>
                                <input type="text" class="form-control" id="create_office" name="create_office" />
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Modal Footer -->
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary submit-btn">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>