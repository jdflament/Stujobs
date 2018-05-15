<html>
<head>
<title>Bienvenue sur Stujobs !</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">
	/* FONTS */
    @media screen {
		@import url('https://fonts.googleapis.com/css?family=Open+Sans');
    }
    
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }

    /* RESET STYLES */
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="font-family: 'Open Sans' ,sans-serif !important;background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td bgcolor="#5681E7" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="480">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;">
                        <a href="{{ env('APP_URL') }}" style="color:#ffffff;font-size:24px;font-weight:400;text-decoration:none;" target="_blank">
                            Stujobs
                            <span style="font-weight:400;font-size: 9px;color: #5681E7;text-transform: uppercase;background: #F9F9F9;padding: 3px 5px;border-radius: 5px;">    
                                beta
                            </span>
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- HERO -->
    <tr>
        <td bgcolor="#5681E7" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="480" >
                <tr>
                    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111;font-size: 48px; font-weight: 400;line-height: 48px;">
                      <h1 style="font-size: 22px; font-weight: 400; margin: 0; color:#5580e7;">Une nouvelle offre correspondant à vos critères est disponible sur Stujobs</h1>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- COPY BLOCK -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="480" style="background-color:#FCFCFC" >
                <!-- COPY -->
              <tr>
                {{-- <td bgcolor="#ffffff" align="left">
                  <p style="margin: 0;">Votre adresse email enregistrée est, merci de cliquez sur le lien ci-dessous pour vérifier votre adresse. </p>
                </td> --}}
                <td style="padding:20px 30px 0px 30px;">
                    <p style="font-size: 18px;color: #5580e7;">{{ $offer->title }}</p>
                </td>
              </tr>
              <tr>
                <td style="padding:5px 30px 20px 30px;">
                    <p style="color: #BBBBBB;position: relative;font-size: 12px;">{{ $offer->city }}</p>
                </td>
              </tr>
              <tr>
                <td style="padding: 15px 30px 20px 30px;">
                    <p style="font-size: 12px;color: #5E5E5E;margin-bottom: 15px;">{{ $offer->description }}</p>
                </td>
              </tr>
              <tr>
                <td style="padding: 0px 30px 20px 30px;">
                    <span style="font-size: 10px;color: #BBBBBB;font-weight: 100;">Type de contrat : </span><span style="margin-right: 35px;font-size: 10px;color: #5e5e5e;font-weight: 600;">{{ $offer->contract_type }}</span>
                    <span style="font-size: 10px;color: #BBBBBB;font-weight: 100;">Secteur : </span><span style="font-size: 10px;color: #5e5e5e;font-weight: 600;">{{ $offer->sector }}</span>                    
                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <tr>
                <td bgcolor="#ffffff" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                          <td align="center" style="border-radius: 3px;" bgcolor="#5681E7"><a href="{{ env('APP_URL') }}/offers/{{$offer->id}}" target="_blank" style="font-size: 20px;color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #7c72dc; display: inline-block;">Voir l'offre</a></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
        </td>
    </tr>
    <!-- FOOTER -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="480" >
              
              <!-- PERMISSION REMINDER -->
              <tr>
                <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666;font-size: 14px; font-weight: 400; line-height: 18px;" >
                  <p style="margin: 0;margin-top:15px;">Vous avez reçu cet email car vous vous êtes inscrit à la newsletter de Stujobs. Si ce n'est pas le cas, <a href="{{ env('APP_URL') }}" target="_blank" style="color: #111111; font-weight: 700;">contactez-nous</a>.</p>
                </td>
              </tr>
              
              <!-- ADDRESS -->
              <tr>
                <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666;font-size: 14px; font-weight: 400; line-height: 18px;" >
                  <p style="text-align:center;margin: 0;">© Stujobs 2018</p>
                </td>
              </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>