<table id="offers-content" class="responsive-table">
    <thead>
    <tr>
        <th scope="col">Titre</th>
        <th scope="col">Type de contrat</th>
        <th scope="col">Durée</th>
        <th scope="col">Rémunération</th>
        <th scope="col">Validée</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr>
            <td scope="row" data-label="Titre"><div style="width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $offer->title ? $offer->title : 'NC' }}</div></td>
            <td scope="row" data-label="Contrat">@lang('vocabulary.contract_type.' . $offer->contract_type)</td>
            <td scope="row" data-label="Durée">{{ $offer->duration ? $offer->duration : 'NC'}}</td>
            <td scope="row" data-label="Rémunération">{{ $offer->remuneration ? $offer->remuneration : 'NC'}}</td>
            <td scope="row" data-label="Validée">
                @if ($offer->valid == 0)
                    <span class="badge bgDanger">Non</span>
                @else
                    <span class="badge bgSuccess">Oui</span>
                @endif
            </td>
            <td scope="row" data-label="Actions">
                @if ($offer->valid == 0)
                <span data-toggle="tooltip" data-placement="top" title="Approuver l'offre">
                    <button data-href="/dashboard/offers/{{ $offer->id }}/approve" class="buttonAction bgSuccess btn-pre-approve-offer" data-toggle="modal" data-target="#modalApproveOffer" style="margin-right: 30px;">
                        <i style="color: white;" class="fa fa-check"></i>
                    </button>
                </span>
                @else
                <span data-toggle="tooltip" data-placement="top" title="Désapprouver l'offre">
                    <button data-href="/dashboard/offers/{{ $offer->id }}/disapprove" class="buttonAction bgDanger btn-pre-disapprove-offer" data-toggle="modal" data-target="#modalDisapproveOffer" style="margin-right: 30px;">
                        <i style="color: white;" class="fa fa-times"></i>
                    </button>
                </span>
                @endif
                <a href="/dashboard/offers/{{ $offer->id }}/show" class="buttonAction bgPrimary" data-toggle="tooltip" data-placement="top" title="Voir l'offre">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <a href="/dashboard/offers/{{ $offer->id }}/edit" class="buttonAction bgWarning btn-pre-edit-offer" data-toggle="tooltip" data-placement="top" title="Modifier">
                    <i style="color: white;" class="fa fa-pencil"></i>
                </a>
                <span data-toggle="tooltip" data-placement="top" title="Supprimer">
                    <button data-href="/dashboard/offers/{{ $offer->id }}/delete" class="buttonAction bgDanger btn-pre-delete-offer" data-toggle="modal" data-target="#modalDeleteOffer">
                        <i class="fa fa-trash"></i>
                    </button>
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>