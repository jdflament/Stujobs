<!-- Modal -->
<div class="modal fade" id="modalChangePassword" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="changePassword" role="form" method="post" action="/dashboard/profile/password/update">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modifier mon mot de passe</h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="current-password">Veuillez saisir votre mot de passe actuel</label>*
                                <input type="password" class="form-control" id="current_password" name="current_password" required="required" placeholder="Mot de passe actuel..."/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="new-password">Veuillez saisir votre nouveau mot de passe</label>*
                                <input type="password" class="form-control" id="new_password" name="new_password" required="required" placeholder="Mot de passe..."/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="new-password-confirm">Veuillez confirmer votre nouveau mot de passe</label>*
                                <input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm" required="required" placeholder="Mot de passe..."/>
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
                    <button type="submit" id="submit-change-password-btn" class="btn btn-primary submit-btn">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>