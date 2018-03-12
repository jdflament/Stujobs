<table id="admins-content" class="table table-response table-bordered table-striped table-hover table-responsive-lg" style="width: 100%;">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($admins as $admin)
        <tr>
            <td>{{ $admin->lastname ? $admin->lastname : 'NC' }}</td>
            <td>{{ $admin->firstname ? $admin->firstname : 'NC'}}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ $admin->role }}</td>
            <td>
                <a href="/dashboard/admins/{{ $admin->id }}/show" class="btn btn-primary btn-sm">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <button data-admin="{{ json_encode($admin) }}" class="btn btn-warning btn-sm btn-pre-edit-admin" data-toggle="modal" data-target="#modalEditAdmin">
                    <i style="color: white;" class="fa fa-pencil"></i>
                </button>
                <button data-href="/dashboard/admins/{{ $admin->id }}/delete" class="btn btn-danger btn-sm btn-pre-delete-admin" data-toggle="modal" data-target="#modalDeleteAdmin">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>