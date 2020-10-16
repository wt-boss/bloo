<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//fr" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{asset('assets/images/bloo_favicon.png')}}">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="{{asset('assets/css/mail.css')}}">

</head>
<body>
     <table class="wrapper table1" width="100%" cellpadding="0" cellspacing="0" >
            <tr>
                <td align="center" >
                    <table class="content" width="100%" cellpadding="0" cellspacing="0" >
                <tr>
                    <td class="header" >

                        <a href="{{ route('home') }}" >
                            Bienvenue sur  bloo App
                        </a>
                    </td>
                </tr>
                <!-- Email Body -->

                <td class="body" width="100%" cellpadding="0" cellspacing="0" >
                        <table class="inner-body"  width="570" cellpadding="0" cellspacing="0" >
                <!-- Body content -->


                    <tr>
                        <td>
                            <a href="{{ route('home')}}">
                                <img src="{{asset('assets/images/bloo_logo2.png')}}" class="img" alt="Bloo">
                            </a>
                        </td>
                    </tr>
                <td class="content-cell" >
                    <h1 >Bonjour,</h1>
                <p>Vous venez d'être ajouté comme lecteur de l'opération en cours. En vous connectant sur la plateforme<a href="https://blooapp.live/login">Bloo</a>, vous pourrez alors visualiser en temps réel les opérations de collecte ainsi que la géolocalisation des opérateurs.
                        <br>Vous recevrez vos accès à la plateforme.
                </p>

                <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" >
                    <tr>
                        <td align="center" >
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                <tr>
                                    <td align= >
                                        <table border="0" cellpadding="0" cellspacing="0" >
                                            <tr>
                                                <td >
                                                    <a href="https://blooapp.live/login" class="button button-blue" target="_blank" >Accéder à Bloo App
                                                    </a>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                                    <br>
                                <p >
                                        Cordialement, <br> l'équipe Bloo
                             </p>
                        </td>
                    </tr>
                </table>

        <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" >
            <tr>
                <td align="center" >

                    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" >
                        <tr>
                        <tr>
                            <td >
                                <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" >
                                    <tr>
                                        <td class="content-cell" align="center" >
                                            <p >© 2020 bloo. All rights reserved.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
</body>
</html>
