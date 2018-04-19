<table id="admins-content" class="responsive-table">
    <thead>
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Email</th>
        <th scope="col">Rôle</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($admins as $admin)
        <tr>
            <td scope="row" data-label="Nom">{{ $admin->lastname ? $admin->lastname : 'NC' }}</td>
            <td scope="row" data-label="Prénom">{{ $admin->firstname ? $admin->firstname : 'NC'}}</td>
            <td scope="row" data-label="Email">{{ $admin->email }}</td>
            <td scope="row" data-label="Rôle">{{ $admin->role }}</td>
            <td scope="row" data-label="Actions">
                <a href="/dashboard/admins/{{ $admin->id }}/show" class="buttonAction bgPrimary btn-sm" data-toggle="tooltip" data-placement="top" title="Voir le profil">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <span data-toggle="tooltip" data-placement="top" title="Modifier">
                    <button data-admin="{{ json_encode($admin) }}" class="buttonAction bgWarning btn-sm btn-pre-edit-admin" data-toggle="modal" data-target="#modalEditAdmin">
                        <i style="color: white;" class="fa fa-pencil"></i>
                    </button>
                </span>
                <span data-toggle="tooltip" data-placement="top" title="Supprimer">
                    <button data-href="/dashboard/admins/{{ $admin->id }}/delete" class="buttonAction bgDanger btn-sm btn-pre-delete-admin" data-toggle="modal" data-target="#modalDeleteAdmin">
                        <i class="fa fa-trash"></i>
                    </button>
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>