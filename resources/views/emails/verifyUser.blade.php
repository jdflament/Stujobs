<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue sur Stujobs !</title>
</head>

<body>
<h2>Bienvenue sur Stujobs, {{$user['email']}}</h2>
<br/>
Votre adresse email enregistrée est {{$user['email']}} , merci de cliquez sur le lien ci-dessous pour vérifier votre adresse.
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}">Vérifier mon adresse</a>
</body>

</html>