<!-- Modal -->
<div class="modal fade" id="modalRefuseApply" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Refuser cette candidature</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <div class="row">
                    <div class="col-md-12">
                        <p>Voulez-vous vraiment refuser cette candidature ?</p>
                        <p>Après cette action, la candidature ne sera pas envoyée à l'entreprise.</p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a href="#" id="btn-refuse-apply" type="submit" class="btn btn-danger submit-btn" style="-webkit-appearance: initial;">Refuser</a>
            </div>
        </div>
    </div>
</div>