<table id="offers-content" class="table table-response table-bordered table-striped table-hover table-responsive-lg" style="width: 100%;">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Type de contrat</th>
        <th>Durée</th>
        <th>Rémunération</th>
        <th>Validée</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr>
            <td><div style="width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $offer->title ? $offer->title : 'NC' }}</div></td>
            <td>@lang('vocabulary.contract_type.' . $offer->contract_type)</td>
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
                @if ($offer->valid == 0)
                <span data-toggle="tooltip" data-placement="top" title="Approuver l'offre">
                    <button data-href="/dashboard/offers/{{ $offer->id }}/approve" class="btn btn-success btn-sm btn-pre-approve-offer" data-toggle="modal" data-target="#modalApproveOffer" style="margin-right: 30px;">
                        <i style="color: white;" class="fa fa-check"></i>
                    </button>
                </span>
                @else
                <span data-toggle="tooltip" data-placement="top" title="Désapprouver l'offre">
                    <button data-href="/dashboard/offers/{{ $offer->id }}/disapprove" class="btn btn-danger btn-sm btn-pre-disapprove-offer" data-toggle="modal" data-target="#modalDisapproveOffer" style="margin-right: 30px;">
                        <i style="color: white;" class="fa fa-times"></i>
                    </button>
                </span>
                @endif
                <a href="/dashboard/offers/{{ $offer->id }}/show" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Voir l'offre">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <a href="/dashboard/offers/{{ $offer->id }}/edit" class="btn btn-warning btn-sm btn-pre-edit-offer" data-toggle="tooltip" data-placement="top" title="Modifier">
                    <i style="color: white;" class="fa fa-pencil"></i>
                </a>
                <span data-toggle="tooltip" data-placement="top" title="Supprimer">
                    <button data-href="/dashboard/offers/{{ $offer->id }}/delete" class="btn btn-danger btn-sm btn-pre-delete-offer" data-toggle="modal" data-target="#modalDeleteOffer">
                        <i class="fa fa-trash"></i>
                    </button>
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>