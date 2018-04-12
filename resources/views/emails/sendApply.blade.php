<!DOCTYPE html>
<html>
<head>
    <title>Stujobs - Un candidat a postulé pour votre annonce !</title>
</head>

<body>
<h2>Bonjour {{ $data['company_name'] }},
 <br />
Le candidat {{ $data['apply_firstname'] }} {{ $data['apply_lastname']}} a postulé pour votre annonce.</h2>
<br/>
<br />
Voici son message : <br/>
<br/>
<?php $message = $data['apply_message']; ?>
<p style="margin: 30px;">" <?php echo nl2br($message) ?> "</p>
<br/>

@if (isset($data['apply_cv_filename']))
<p>Vous pouvez également retrouver son CV en pièce jointe.</p>
@endif
<br />
<a href="mailto:{{ $data['apply_email'] }}">Contacter le candidat par email</a>
<a href="tel:{{ $data['apply_phone'] }}">Contacter le candidat par téléphone</a>
</body>

</html>