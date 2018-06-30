<!-- Modal -->
<div class="modal fade" id="modalDownloadData" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modalContent">
            <form name="downloadData" role="form" method="post" action="/informations/download">
                <!-- Modal Header -->
                <div class="modalHeader">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="modalTitle" id="myModalLabel">Télécharger toutes vos informations</h3>
                </div>
                <!-- Modal Body -->
                <div class="modalBody">
                    <p>Vous pouvez récupérer une copie de toutes les données existantes sur Stujobs vous concernant. Si vous souhaitez poursuivre, veuillez saisir votre adresse email utilisée sur notre site afin d'obtenir votre code de vérification.</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label for="download_password">Votre adresse email *</label>
                                <input type="email" id="download_email" name="download_email" required="required" placeholder="Votre adresse email" />
                                @if ($errors->has('download_email'))
                                    <div class="error">{{ $errors->first('download_email') }}</div>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modalFooter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="buttonActionLg bgDefault" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="buttonActionLg bgPrimary submit-btn">Télécharger</button>
                </div>
            </form>
        </div>
    </div>
</div>