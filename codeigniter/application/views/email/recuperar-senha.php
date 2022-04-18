<?php

if (!function_exists('get_dia_semana')) {
    function get_dia_semana($day)
    {
        $days = array(
            'Domingo',
            'Segunda-feira',
            'Terça-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira',
            'Sábado',
        );

        if (isset($days[$day])) {
            return $days[$day];
        }

        return '';

    }
}
if (!function_exists('get_mes_extenso')) {
    function get_mes_extenso($mes)
    {
        switch ($mes) {
            case 1:
                $mes = 'Janeiro';
                break;
            case 2:
                $mes = 'Fevereiro';
                break;
            case 3:
                $mes = 'Março';
                break;
            case 4:
                $mes = 'Abril';
                break;
            case 5:
                $mes = 'Maio';
                break;
            case 6:
                $mes = 'Junho';
                break;
            case 7:
                $mes = 'Julho';
                break;
            case 8:
                $mes = 'Agosto';
                break;
            case 9:
                $mes = 'Setembro';
                break;
            case 10:
                $mes = 'Outubro';
                break;
            case 11:
                $mes = 'Novembro';
                break;
            case 12:
                $mes = 'Dezembro';
                break;
            default :
                $mes = '';
                break;
        }

        return $mes;
    }
}
if (!function_exists('base_url_email')) {
    function base_url_email($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}

$data_extenso = sprintf('%s de %s de %s',date('d'), get_mes_extenso(date('m')), date('Y')); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

    <title>Email Template</title>

    <style type="text/css">

        body{
            width: 100%;
            background-color: #E8E8E8;
            margin:0;
            padding:0;
            -webkit-font-smoothing: antialiased;
            font-family: arial;
        }

        html{
            width: 100%;
        }

        table, td, th {
            font-size: 12px;
            border: 0;
            vertical-align: top;
        }

        a {
            color: #000CFF;
        }

    </style>

</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" cz-shortcut-listen="true">

<table border="0" cellpadding="0" cellspacing="0" width="100%">

    <tbody>

    <tr><td height="30"></td></tr>

    <tr bgcolor="#E8E8E8">
        <td align="center" bgcolor="#E8E8E8" valign="top" width="100%">

            <!--  top header -->
            <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tbody>
                <tr bgcolor="#000CFF"><td height="15"></td></tr>
                <tr bgcolor="#000CFF">
                    <td align="center">
                        <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">
                            <tbody>
                            <tr>
                                <td>
                                    <table class="top-header-left" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <table class="date" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <img style="display: block;" src="<?php echo base_url_email().'assets/images/mailer/images/icon-cal.png' ?>" alt="icon 1" width="13">
                                                        </td>
                                                        <td>&nbsp;&nbsp;</td>
                                                        <td style="color: #fefefe; font-size: 11px; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">
                                                            <singleline>
                                                                <?php echo $data_extenso; ?>
                                                            </singleline>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="top-header-right" align="left" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr><td height="20" width="30"></td></tr>
                                        </tbody>
                                    </table>

                                    <table class="top-header-right" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <table class="tel" align="center" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <img style="display: block;" src="<?php echo base_url_email().'assets/images/mailer/images/icon-tel.png' ?>" alt="icon 2" width="17">
                                                        </td>
                                                        <td>&nbsp;&nbsp;</td>
                                                        <td style="color: #fefefe; font-size: 11px; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">
                                                            <singleline>
                                                                Contato: <?php echo $objConfiguracao['telefone'] ?>
                                                            </singleline>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr bgcolor="#000CFF"><td height="10"></td></tr>
                </tbody>
            </table>
            <!--  end top header  -->


            <!-- main content -->
            <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#e2e2e2">

                <tbody>

                <!--Header-->
                <tr><td height="30"></td></tr>

                <tr>
                    <td>
                        <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">
                            <tbody>
                            <tr>
                                <td>
                                    <table class="logo" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <a href="" style="display: block;">
                                                    <img style="display: block;" src="<?php echo base_url_email().'central/images/logo_topo.svg' ?>" alt="logo" height="45">
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr><td height="30"></td></tr>
                <!-- end header -->

                <!-- main section -->
                <tr>
                    <td>
                        <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">

                            <tbody>

                            <tr><td height="10"></td></tr>

                            <tr>
                                <td>
                                    <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">

                                        <tbody>

                                        <tr><td height="10"></td></tr>

                                        <tr>
                                            <td>
                                                <table class="mainContent" align="center" border="0" cellpadding="0" cellspacing="0" width="528">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <h2 style="color: #333333;font-size: 16px;font-weight: bold;font-family: Helvetica, Arial, sans-serif;letter-spacing: 2px;text-transform: uppercase;margin-bottom: 30px;text-align: center;">
                                                                Olá <?php echo $objCliente->getNome() ?>!
                                                            </h2>

                                                            <p style="color: #636363;font-size: 12px;font-weight: normal;line-height: 20px;font-family: Helvetica, Arial, sans-serif;">
                                                                Para iniciar o processo de redefinição de senha, clique no link abaixo:
                                                                <br />

                                                                <a href='<?php echo base_url_email() . 'clientes/novasenha/' . $objCliente->getRecuperacaoSenhaToken() ?>'>
                                                                    <?php echo base_url_email() . 'clientes/novasenha/' . $objCliente->getRecuperacaoSenhaToken() ?>
                                                                </a>
                                                                <br /><br />

                                                                Se ao clicar no link acima não funcionar, copie e cole o URL em uma nova janela do navegador. <br /><br />

                                                                Se você recebeu esta mensagem por engano, é provável que outro usuário tenha inserido <br />
                                                                seu endereço de e-mail por engano ao tentar redefinir uma senha. Se você não iniciar a <br />
                                                                solicitação, você não precisa tomar nenhuma providência e pode seguramente desconsiderar <br />
                                                                este e-mail.
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr><td height="30"></td></tr>

                                        </tbody>

                                    </table>
                                </td>
                            </tr>

                            <tr><td height="30"></td></tr>

                            </tbody>

                        </table>
                    </td>
                </tr>
                <!-- end main section -->


                <!-- prefooter -->
                <tr>
                    <td>
                        <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">
                            <tbody>
                            <tr>
                                <td>
                                    <table class="nav" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr><td height="10"></td></tr>
                                        <tr>
                                            <td style="font-size: 13px; font-family: Helvetica, Arial, sans-serif;" align="center">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <a style="display: block; width: 16px;" href="https://www.facebook.com/">
                                                                <img style="display: block;" src="<?php echo base_url_email().'assets/images/mailer/images/social-facebook.png' ?>">
                                                            </a>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                                        <td>
                                                            <a style="display: block; width: 16px;" href="https://www.instagram.com/">
                                                                <img style="display: block;" src="<?php echo base_url_email().'assets/images/mailer/images/social-instagram.png' ?>">
                                                            </a>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;</td>
                                                        <td>
                                                            <a style="display: block; width: 16px;" href="https://www.youtube.com/">
                                                                <img style="display: block;" src="<?php echo base_url_email().'assets/images/mailer/images/social-youtube.png' ?>">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <!-- end prefooter  -->

                <tr><td height="20"></td></tr>

                <tr>
                    <td style="color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;" class="prefooter-subheader" align="center">
                        <span style="color: #000CFF">Contato:</span> <?php echo $objConfiguracao['telefone'] ?>    &nbsp;&nbsp;&nbsp;
                        <span style="color: #000CFF">E-mail:</span> <?php echo $objConfiguracao['email'] ?>
                    </td>
                </tr>

                <tr><td height="30"></td></tr>

                </tbody>
            </table>
            <!--end main Content -->

            <!-- end footer-->
        </td>
    </tr>

    <tr><td height="30"></td></tr>

    </tbody>
</table>



</body>
</html>
