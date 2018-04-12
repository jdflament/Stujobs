<table id="applies-content" class="table table-response table-bordered table-striped table-hover table-responsive-lg" style="width: 100%;">
    <thead>
    <tr>
        <th>Candidat</th>
        <th>CV</th>
        <th>Offre</th>
        <th>Validation</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applies as $apply)
        <tr>
            <td>{{ $apply->apply_firstname }} {{ $apply->apply_lastname }}</td>
            <td>{{ $apply->apply_cv_filename ? 'Oui' : 'Non'}}</td>
            <td><a style="color: #3f8adc" href="/dashboard/offers/{{ $apply->offer_id }}/show">{{ $apply->offer_title }}</a></td>
            <td>
                @if ($apply->apply_valid == 0)
                    <span class="badge badge-info">En attente</span>
                @elseif ($apply->apply_valid == 1)
                    <span class="badge badge-success">Acceptée</span>
                @elseif ($apply->apply_valid == 2)
                    <span class="badge badge-danger">Refusée</span>
                @endif
            </td>
            <td>
                <a href="/dashboard/applies/{{ $apply->apply_id }}/show" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Voir la candidature">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <span data-toggle="tooltip" data-placement="top" title="Supprimer">
                    <button data-href="/dashboard/applies/{{ $apply->apply_id }}/delete" class="btn btn-danger btn-sm btn-pre-delete-apply" data-toggle="modal" data-target="#modalDeleteApply">
                        <i class="fa fa-trash"></i>
                    </button>
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>