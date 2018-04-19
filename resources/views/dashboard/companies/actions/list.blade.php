<table id="companies-content" class="responsive-table">
    <thead>
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Email</th>
        <th scope="col">Rôle</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($companies as $company)
        <tr>
            <td scope="row" data-label="Nom">{{ $company->name ? $company->name : 'NC' }}</td>
            <td scope="row" data-label="Email">{{ $company->email }}</td>
            <td scope="row" data-label="Rôle">{{ $company->role }}</td>
            <td scope="row" data-label="Actions">
                <a href="/dashboard/companies/{{ $company->id }}/show" class="buttonAction bgPrimary btn-sm" data-toggle="tooltip" data-placement="top" title="Voir le profil">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <span data-toggle="tooltip" data-placement="top" title="Modifier">
                    <button data-company="{{ json_encode($company) }}" class="buttonAction bgWarning btn-sm btn-pre-edit-company" data-toggle="modal" data-target="#modalEditCompany">
                        <i style="color: white;" class="fa fa-pencil"></i>
                    </button>
                </span>
                <span data-toggle="tooltip" data-placement="top" title="Supprimer">
                    <button data-href="/dashboard/companies/{{ $company->id }}/delete" class="buttonAction bgDanger btn-sm btn-pre-delete-company" data-toggle="modal" data-target="#modalDeleteCompany">
                        <i class="fa fa-trash"></i>
                    </button>
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>