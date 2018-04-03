<div class="row">
    <div class="col-md-6 col-xs-12 col-lg-6">
        <h6 style="text-align: center">Informations du compte</h6>
        <table class="table table-responsive-sm table-hover table-bordered">
            <tbody>
            <tr>
                <th>Email</th>
                <td>{{ $company->email }}</td>
            </tr>
            <tr>
                <th>Rôle</th>
                <td>{{ $company->role }}</td>
            </tr>
            <tr>
                <th>Membre depuis le</th>
                <td>{{ $company->created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h6 style="text-align: center">Informations complémentaires</h6>
        <table class="table table-responsive-sm table-hover table-bordered">
            <tbody>
            <tr>
                <th>Raison Sociale</th>
                <td>{{ $company->name ? $company->name : 'NC' }}</td>
            </tr>
            <tr>
                <th>SIRET</th>
                <td>{{ $company->siret ? $company->siret : 'NC' }}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{ $company->address ? $company->address : 'NC' }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $company->phone ? $company->phone : 'NC' }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>