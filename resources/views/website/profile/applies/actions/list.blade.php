<table id="applies-content" class="responsive-table">
    <thead>
    <tr>
        <th scope="col">État</th>
        <th scope="col">Date</th>
        <th scope="col">Candidat</th>
        <th scope="col">CV</th>
        <th scope="col">Offre</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if (count($applies) > 0)
    @foreach($applies as $apply)
        <tr>
            <?php
            $date = new \Carbon\Carbon($apply->apply_created_at);
            $date::setLocale('fr');
            ?>
            <td scope="row" data-label="État">
                @if ($apply->apply_valid == 0)
                    <span class="badge bgWarning">En attente</span>
                @elseif ($apply->apply_valid == 1)
                    <span class="badge bgSuccess">Acceptée</span>
                @elseif ($apply->apply_valid == 2)
                    <span class="badge bgDanger">Refusée</span>
                @endif
            </td>
            <td scope="row" data-label="Date">{{ $date->diffForHumans() }}</td>
            <td scope="row" data-label="Candidat">{{ $apply->apply_firstname }} {{ $apply->apply_lastname }}</td>
            <td scope="row" data-label="CV">{{ $apply->apply_cv_filename ? 'Oui' : 'Non'}}</td>
            <td scope="row" data-label="Offre"><a style="color: #3f8adc" href="/profile/offers/{{ $apply->offer_id }}/show">{{ $apply->offer_title }}</a></td>
            <td scope="row" data-label="Actions">
                <a href="/profile/applies/{{ $apply->apply_id }}/show" class="buttonAction bgPrimary" data-toggle="tooltip" data-placement="top" title="Voir la candidature">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
    @endforeach
    @else
        <tr>
            <td colspan="6" align="center">Aucune candidature n'a été déposée pour vos offres.</td>
        </tr>
    @endif
    </tbody>
</table>