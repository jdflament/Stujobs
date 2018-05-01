<table id="offers-content" class="responsive-table">
    <thead>
    <tr>
        <th scope="col">En ligne</th>
        <th scope="col">Titre</th>
        <th scope="col">Type de contrat</th>
        <th scope="col">Durée</th>
        <th scope="col">Rémunération</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if (count($offers) > 0)
    @foreach($offers as $offer)
        <tr>
            @if ($offer->valid == 1 && $offer->complete == 0)
            <td scope="row" data-label="En ligne"><span class="badge bgSuccess">Oui</span></td>
            @else
            <td scope="row" data-label="En ligne"><span class="badge bgDanger">Non</span></td>
            @endif
            <td scope="row" data-label="Titre"><div class="truncateText">{{ $offer->title ? $offer->title : 'NC' }}</div></td>
            <td scope="row" data-label="Type de contrat">@lang('vocabulary.contract_type.' . $offer->contract_type)</td>
            <td scope="row" data-label="Durée">{{ $offer->duration ? $offer->duration : 'NC'}}</td>
            <td scope="row" data-label="Rémunération">{{ $offer->remuneration ? $offer->remuneration : 'NC'}}€ / h</td>
            <td scope="row" data-label="Actions">
                <a href="/profile/offers/{{ $offer->id }}/show" class="buttonAction bgPrimary" data-toggle="tooltip" data-placement="top" title="Voir l'offre">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <a href="/profile/offers/{{ $offer->id }}/edit" class="buttonAction bgWarning btn-pre-edit-offer" data-toggle="tooltip" data-placement="top" title="Modifier">
                    <i style="color: white;" class="fa fa-pencil"></i>
                </a>
                <span data-toggle="tooltip" data-placement="top" title="Supprimer">
                    <button data-href="/profile/offers/{{ $offer->id }}/delete" class="buttonAction bgDanger btn-pre-delete-offer" data-toggle="modal" data-target="#modalDeleteOffer" style="cursor: pointer;">
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