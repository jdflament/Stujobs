<div class="row">
    <div class="col-md-6 col-xs-12 col-lg-6">
        <h6 style="text-align: center">Informations du compte</h6>
        <table class="table table-responsive-sm table-hover table-bordered">
            <tbody>
            <tr>
                <th>Email</th>
                <td>{{ $admin->email }}</td>
            </tr>
            <tr>
                <th>Rôle</th>
                <td>{{ $admin->role }}</td>
            </tr>
            <tr>
                <th>Membre depuis le</th>
                <td>{{ $admin->created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h6 style="text-align: center">Informations complémentaires</h6>
        <table class="table table-responsive-sm table-hover table-bordered">
            <tbody>
            <tr>
                <th>Nom</th>
                <td>{{ $admin->lastname ? $admin->lastname : 'NC' }}</td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td>{{ $admin->firstname ? $admin->firstname : 'NC' }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $admin->phone ? $admin->phone : 'NC' }}</td>
            </tr>
            <tr>
                <th>Poste</th>
                <td>{{ $admin->office ? $admin->office : 'NC' }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>