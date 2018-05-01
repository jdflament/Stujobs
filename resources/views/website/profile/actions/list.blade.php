<p class="paragraphe"><span class="smallText">Email : </span> {{ $company->email }}</p>
<p class="paragraphe"><span class="smallText">Rôle : </span> {{ $company->role }}</p>
<?php
$date = new \Carbon\Carbon($company->created_at);
$date::setLocale('fr');
?>
<p class="paragraphe"><span class="smallText">Inscription : </span> {{ $date->diffForHumans() }}</p>
<p class="paragraphe"><span class="smallText">Raison Sociale : </span> {{ $company->name ? $company->name : 'NC' }}</p>
<p class="paragraphe"><span class="smallText">SIRET : </span> {{ $company->siret ? $company->siret : 'NC' }}</p>
<p class="paragraphe"><span class="smallText">Adresse : </span> {{ $company->address ? $company->address : 'NC' }}</p>
<p class="paragraphe"><span class="smallText">Téléphone : </span> {{ $company->phone ? $company->phone : 'NC' }}</p>