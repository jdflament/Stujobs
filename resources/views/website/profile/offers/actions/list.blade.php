<table id="offers-content" class="table table-response table-bordered table-striped table-hover table-responsive-lg" style="width: 100%;">
    <thead>
    <tr>
        <th>En ligne</th>
        <th>Titre</th>
        <th>Type de contrat</th>
        <th>Durée</th>
        <th>Rémunération</th>
        <th>Validée</th>
        <th>Terminée</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @if (count($offers) > 0)
    @foreach($offers as $offer)
        <tr>
            @if ($offer->valid == 1 && $offer->complete == 0)
            <td><span class="badge badge-success">Oui</span></td>
            @else
            <td><span class="badge badge-danger">Non</span></td>
            @endif
            <td>{{ $offer->title ? $offer->title : 'NC' }}</td>
            <td>@lang('vocabulary.' . $offer->contract_type)</td>
            <td>{{ $offer->duration ? $offer->duration : 'NC'}}</td>
            <td>{{ $offer->remuneration ? $offer->remuneration : 'NC'}}</td>
            <td>
                @if ($offer->valid == 0)
                    <span class="badge badge-danger">Non</span>
                @else
                    <span class="badge badge-success">Oui</span>
                @endif
            </td>
            <td>
                @if ($offer->complete == 0)
                    <span class="badge badge-success">Non</span>
                @else
                    <span class="badge badge-danger">Oui</span>
                @endif
            </td>
            <td>
                @if ($offer->complete == 0)
                    <span data-toggle="tooltip" data-placement="top" title="Terminer l'offre">
                        <button data-href="/profile/offers/{{ $offer->id }}/complete" class="btn btn-success btn-sm btn-pre-complete-offer" data-toggle="modal" data-target="#modalCompleteOffer" style="margin-right: 30px;">
                            <i style="color: white;" class="fa fa-check"></i>
                        </button>
                    </span>
                @else
                    <span data-toggle="tooltip" data-placement="top" title="Ré-activer l'offre">
                        <button data-href="/profile/offers/{{ $offer->id }}/uncomplete" class="btn btn-danger btn-sm btn-pre-uncomplete-offer" data-toggle="modal" data-target="#modalUncompleteOffer" style="margin-right: 30px;">
                            <i style="color: white;" class="fa fa-refresh"></i>
                        </button>
                    </span>
                @endif
                <a href="/profile/offers/{{ $offer->id }}/show" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Voir l'offre">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <span data-toggle="tooltip" data-placement="top" title="Modifier">
                    <button data-offer="{{ json_encode($offer) }}" class="btn btn-warning btn-sm btn-pre-edit-offer" data-toggle="modal" data-target="#modalEditOffer">
                        <i style="color: white;" class="fa fa-pencil"></i>
                    </button>
                </span>
                <span data-toggle="tooltip" data-placement="top" title="Supprimer">
                    <button data-href="/profile/offers/{{ $offer->id }}/delete" class="btn btn-danger btn-sm btn-pre-delete-offer" data-toggle="modal" data-target="#modalDeleteOffer">
                        <i class="fa fa-trash"></i>
                    </button>
                </span>
            </td>
        </tr>
    @endforeach
    @else
    <tr>
        <td align="center" colspan="8">Vous n'avez pas encore publié d'offre d'emploi.</td>
    </tr>
    @endif
    </tbody>
</table>