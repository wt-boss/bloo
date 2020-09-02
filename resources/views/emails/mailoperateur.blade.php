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
                    </table>
                </td>
                <tr>
                    <td class="header" >

                        <a href="{{ route('home') }}" >
                            Bienvenue sur  bloo App
                        </a>
                    </td>
                </tr>
                <!-- Email Body -->

                <td class="body" width="100%" cellpadding="0" cellspacing="0" >
                        <table class="inner-body" width="570" cellpadding="0" cellspacing="0" >
                <!-- Body content -->


                    <tr>
                        <td class="header logo" >
                            <a href="{{ route('home')}}" >
                                <img src="{{asset('assets/images/bloo_logo.png')}}" style="width: 75px; height: auto;"  alt="Bloo" class="img"  >
                            </a>
                        </td>
                    </tr>
                <td class="content-cell" >
                    <h1 >Bienvenue sur Bloo,</h1>
                <p>
                    Votre profil a été validé.<br>
                    Ci-dessous tes accès de connexion
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
                                                    <a href="#" class="button button-blue" target="_blank" >Accéder à Bloo App
                                                    </a>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                                    <br>
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
