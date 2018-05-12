<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue sur Stujobs !</title>
</head>

<body style="background-color:#f2f2f2;">
    <div style="background-color:#5681E7;padding:30px;text-align:center;">
        <a style="color:#ffffff;font-size:24px;font-weight:600;text-decoration:none;" href="http://stujobs.admin">Stujobs<span style="font-weight:400;position:relative;top: -9px;right: -4px;font-size: 9px;color: #5681E7;text-transform: uppercase;background: #F9F9F9;padding: 3px 5px;border-radius: 5px;box-shadow: 0px 2px 4px 0px rgba(86,86,86,0.35);">beta</span></a>
    </div>
    <div style="display:flex;justify-content:center;margin: 0px 100px;backgound-color:#f2f2f2;">
        <div style="background-color: #fff;border-radius: 2px;box-shadow: 0 3px 7px 1px rgba(0, 0, 0, 0.09);padding:20px 50px;">
            <h2>Bienvenue sur Stujobs, {{$user['email']}}</h2>
            <p>Votre adresse email enregistrée est {{$user['email']}} , merci de cliquez sur le lien ci-dessous pour vérifier votre adresse.</p>
            <a href="{{url('user/verify', $user->verifyUser->token)}}">Vérifier mon adresse</a>
        </div>
    </div>
</body>

</html>