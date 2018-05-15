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
                      <h1 style="font-size: 22px; font-weight: 400; margin: 0; color:#5580e7;">Bonjour {{ $data['company_name'] }},</h1>
                      <h3 style="font-size: 16px; font-weight: 400; margin: 0; color:#5E5E5E;">Le candidat <span style="color:#5580e7;">{{ $data['apply_firstname'] }} {{ $data['apply_lastname']}}</span> a postulé pour votre annonce.</h3>
                      <p style="font-size: 16px; font-weight: 400; margin: 0; color:#5E5E5E;">Voici son message :</p>
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
                <td style="padding:20px 30px 20px 30px;">
                    <?php $message = $data['apply_message']; ?>
                    <p style="font-size: 14px;color: #5E5E5E;word-break:break-word;"><?php echo nl2br($message) ?></p>
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
                            @if (isset($data['apply_cv_filename']))
                                <p style="font-size: 14px; font-weight: 400; margin: 0; color:#5E5E5E;margin-bottom:15px;">Vous pouvez retrouver le CV du candidat en pièce jointe.</p>
                            @else 
                                <p style="font-size: 14px; font-weight: 400; margin: 0; color:#5E5E5E;margin-bottom:15px;">Le candidat n'a pas joint de CV à sa candidature.</p>
                            @endif                                                 
                          </tr>
                          <tr>
                            <p style="font-size: 16px; font-weight: 400; margin: 0; color:#5E5E5E;margin-bottom:15px;">Contacter le candidat :</p>
                          </tr>
                          <tr>
                          <td style="border-radius: 3px;" bgcolor="#5681E7"><a href="mailto:{{ $data['apply_email'] }}" target="_blank" style="font-size: 14px;color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 5px 15px; border-radius: 2px; border: 1px solid #5681E7; display: inline-block;">Par mail</a></td>
                          <td style="width:10px;"></td>
                          <td style="border-radius: 3px;" bgcolor="#5681E7"><a href="tel:{{ $data['apply_phone'] }}" target="_blank" style="font-size: 14px;color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 5px 15px; border-radius: 2px; border: 1px solid #5681E7; display: inline-block;">Par téléphone</a></td>
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
                  <p style="margin: 0;margin-top:15px;">Vous avez reçu cet email car un candidat a postulé à votre offre. Si vous n'avez pas déposé d'offre sur Stujobs, <a href="mailto:{{ env('MAIL_USERNAME') }}" target="_blank" style="color: #111111; font-weight: 700;">contactez-nous</a>.</p>
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