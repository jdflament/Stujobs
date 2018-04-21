<table id="offers-content" class="responsive-table">
    <thead>
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Titre</th>
        <th scope="col">Type de contrat</th>
        <th scope="col">Durée</th>
        <th scope="col">Validation</th>
        <th scope="col">État</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr>
            <?php
            $date = new \Carbon\Carbon($offer->created_at);
            $date::setLocale('fr');
            ?>
            <td scope="row" data-label="Date">{{ $date->diffForHumans() }}</td>
            <td scope="row" data-label="Titre"><div class="truncateText">{{ $offer->title ? $offer->title : 'NC' }}</div></td>
            <td scope="row" data-label="Contrat"><div class="truncateText"><span class="@lang('vocabulary.contract_type_colors.' . $offer->contract_type)">@lang('vocabulary.contract_type.' . $offer->contract_type)</span></div></td>
            <td scope="row" data-label="Durée">{{ $offer->duration ? $offer->duration : 'NC'}}</td>
            <td scope="row" data-label="Validation">
                @if ($offer->valid == 0)
                    <span class="badge bgDanger">Désapprouvée</span>
                @else
                    <span class="badge bgSuccess">Approuvée</span>
                @endif
            </td>
                <td scope="row" data-label="État">
                    @if ($offer->complete == 0)
                        <span class="badge bgWarning">En cours</span>
                    @else
                        <span class="badge bgInfo">Clôturée</span>
                    @endif
                </td>
            <td scope="row" data-label="Actions">
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