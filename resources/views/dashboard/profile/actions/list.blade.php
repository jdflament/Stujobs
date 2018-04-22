<p class="paragraphe"><span class="smallText">Nom : </span> {{ $admin->lastname ? $admin->lastname : 'NC' }}</p>
<p class="paragraphe"><span class="smallText">Prénom : </span> {{ $admin->firstname ? $admin->firstname : 'NC' }}</p>
<p class="paragraphe"><span class="smallText">Email : </span> {{ $admin->email }}</p>
<p class="paragraphe"><span class="smallText">Rôle : </span> {{ $admin->role }}</p>
<?php
$date = new \Carbon\Carbon($admin->created_at);
$date::setLocale('fr');
?>
<p class="paragraphe"><span class="smallText">Création de compte : </span> {{ $date->diffForHumans() }}</p>
<p class="paragraphe"><span class="smallText">Tél : </span> {{ $admin->phone ? $admin->phone : 'NC' }}</p>
<p class="paragraphe"><span class="smallText">Poste : </span> {{ $admin->office ? $admin->office : 'NC' }}</p>