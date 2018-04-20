<!-- Modal -->
<div class="modal fade" id="modalCreateCompany" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="createCompany" role="form" method="post" action="/dashboard/companies">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modalTitle" id="myModalLabel">Ajouter une nouvelle entreprise</h4>
                </div>

                <!-- Modal Body -->
                <div class="modalBody">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_email">Email de l'entreprise *</label>
                                <input type="text" id="create_email" name="create_email" required="required" placeholder="Ex : company@mail.com" value="{{ old('create_email') }}"/>
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
                                        <option disabled selected value="">Sélectionner un rôle</option>
                                        <option @if(old('create_role') && old('create_role') == 'company') selected="selected" @endif value="company">Entreprise</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_name">Nom de l'entreprise</label>
                                <input type="text" id="create_name" name="create_name" value="{{ old('create_name') }}" placeholder="Ex : My Company" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_siret">SIRET</label>
                                <input type="text" id="create_siret" name="create_siret" value="{{ old('create_siret') }}" placeholder="Ex : 362 521 879 00034" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_address">Adresse</label>
                                <input type="text" id="create_address" name="create_address" value="{{ old('create_address') }}" placeholder="Ex : 15 rue Victor Hugo" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="create_phone">Téléphone</label>
                                <input type="text" id="create_phone" name="create_phone" value="{{ old('create_phone') }}" placeholder="Ex : 0301020304" />
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
            @endforeach

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