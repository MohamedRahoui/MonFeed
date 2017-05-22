<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Confirmation de votre email </title>
</head>

<body>
<div style="background-color:#fff;margin:0 auto 0 auto;padding:30px 0 30px 0;color:#4f565d;font-size:13px;line-height:20px;font-family:'Helvetica Neue',Arial,sans-serif;text-align:left;">
    <div style="text-align: center;">
        <table style="width:550px;text-align:center">
            <tbody>
            <tr>
                <td style="padding:0 0 20px 0;border-bottom:1px solid #e9edee;">
                    <a href="{{url('/')}}" style="display:block; margin:0 auto;" target="_blank">
                        <img src="https://image.ibb.co/b9LZkk/logo.png" height="75"
                             alt="MonFeed Logo" style="border: 0px;">
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:30px 0;">
                    <p style="color:#1d2227;line-height:28px;font-size:22px;margin:12px 10px 20px 10px;font-weight:400;">
                        Salut {{$user->first_name}} {{$user->last_name}}, merci pour choisir MonFeed.</p>
                    <p style="margin:0 10px 10px 10px;padding:0;">Il ne vous reste qu'une seule étape</p>
                    <p>
                        <a style="display:inline-block;text-decoration:none;padding:15px 20px;background-color:#2baaed;border:1px solid #2baaed;border-radius:3px;color:#FFF;font-weight:bold;"
                           href="{{url('validate_email/'.$user->key)}}" target="_blank">Confirmez votre Émail</a>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:30px 0 0 0;border-top:1px solid #e9edee;color:#9b9fa5">
                    Si vous avez des questions contactez nous sur <a style="color:#666d74;text-decoration:none;"
                                                                     href="mailto:support@monfeed.fr" target="_blank">support@MonFeed
                        .fr</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
