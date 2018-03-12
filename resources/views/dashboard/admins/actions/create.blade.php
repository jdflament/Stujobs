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
                                <label for="email">Email de l'administrateur</label>*
                                <input type="text" class="form-control" id="email" name="email" required="required" placeholder="Ex : admin@mail.com"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Mot de passe</label>*
                                <input type="password" class="form-control" id="password" name="password" required="required" placeholder="Mot de passe..."/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Libellé de l'adresse</label>*
                                <select class="form-control" id="role" name="role" required="required">
                                    <option disabled selected value="">Sélectionner un rôle</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
            @endforeach

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