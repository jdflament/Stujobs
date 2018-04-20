<!-- Modal -->
<div class="modal fade" id="modalCreateAdmin" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="createAdmin" role="form" method="post" action="/dashboard/admins">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="modalTitle" id="myModalLabel">Ajouter un nouvel administrateur</h3>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_email">Email de l'administrateur *</label>
                                <input type="text" id="create_email" name="create_email" required="required"  placeholder="Ex : admin@mail.com" value="{{ old('create_email') }}" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_password">Mot de passe *</label>
                                <input type="password" id="create_password" name="create_password" required="required" placeholder="Mot de passe..." value="{{ old('create_password') }}"/>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="inputGroup">
                                <label for="create_role">Rôle *</label>
                                <div class="formSelect">
                                    <select id="create_role" name="create_role" required="required">
                                        <option disabled @if(!old('create_role')) selected @endif value="">Sélectionner un rôle</option>
                                        <option @if(old('create_role') && old('create_role') == 'superadmin') selected="selected" @endif value="superadmin">Super Admin</option>
                                        <option @if(old('create_role') && old('create_role') == 'admin') selected="selected" @endif value="admin">Administrateur</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_firstname">Prénom</label>
                                <input type="text" id="create_firstname" name="create_firstname" value="{{ old('create_firstname') }}" placeholder="Ex : John" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_lastname">Nom</label>
                                <input type="text" id="create_lastname" name="create_lastname" value="{{ old('create_lastname') }}" placeholder="Ex : Doe" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_phone">Téléphone</label>
                                <input type="text" id="create_phone" name="create_phone" value="{{ old('create_phone') }}" placeholder="Ex : 0601020304" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_office">Fonction</label>
                                <input type="text" id="create_office" name="create_office" value="{{ old('create_office') }}" placeholder="Ex : Informaticien" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgPrimary submit-btn">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>