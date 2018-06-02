<div class="row">
    <div class="col-xs-12 col-md-4 col-lg-4">
        <div class="logoBox" style="background-image:url('{{ $company->logo_filename ? asset('storage/logos') . '/' . $company->logo_filename : asset('storage/logos/default-image.png') }}')">
        </div>
    </div>
    <div class="col-xs-12 col-md-8 col-lg-8">
        <p class="paragraphe"><span class="smallText">Email : </span> {{ $company->email }}</p>
        <p class="paragraphe"><span class="smallText">Rôle : </span> @lang('vocabulary.user_role.' . $company->role)</p>
        <?php
        $date = new \Carbon\Carbon($company->created_at);
        $date::setLocale('fr');
        ?>
        <p class="paragraphe"><span class="smallText">Inscription : </span> {{ $date->diffForHumans() }}</p>
        <p class="paragraphe"><span class="smallText">Raison Sociale : </span> {{ $company->name ? $company->name : 'NC' }}</p>
        <p class="paragraphe"><span class="smallText">SIRET : </span> {{ $company->siret ? $company->siret : 'NC' }}</p>
        <p class="paragraphe"><span class="smallText">Adresse : </span> {{ $company->address ? $company->address : 'NC' }}</p>
        <p class="paragraphe"><span class="smallText">Téléphone : </span> {{ $company->phone ? $company->phone : 'NC' }}</p>
        <p class="paragraphe"><span class="smallText">Description : </span> {{ $company->description ? $company->description : 'NC' }}</p>
    </div>
</div>