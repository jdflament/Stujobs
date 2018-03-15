<table id="companies-content" class="table table-response table-bordered table-striped table-hover table-responsive-lg" style="width: 100%;">
    <thead>
    <tr>
        <th>Nom</th>
        <th>SIRET</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($companies as $company)
        <tr>
            <td>{{ $company->name ? $company->name : 'NC' }}</td>
            <td>{{ $company->siret ? $company->siret : 'NC'}}</td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->role }}</td>
            <td>
                <a href="/dashboard/companies/{{ $company->id }}/show" class="btn btn-primary btn-sm">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <button data-company="{{ json_encode($company) }}" class="btn btn-warning btn-sm btn-pre-edit-company" data-toggle="modal" data-target="#modalEditCompany">
                    <i style="color: white;" class="fa fa-pencil"></i>
                </button>
                <button data-href="/dashboard/companies/{{ $company->id }}/delete" class="btn btn-danger btn-sm btn-pre-delete-company" data-toggle="modal" data-target="#modalDeleteCompany">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>