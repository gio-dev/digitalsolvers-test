<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('enviar_emails')){
    function enviar_emails($from, $to, $message, $subject = null, $replyTo = null)
    {
//        if($_SERVER['HTTP_HOST']=="localhost"||$_SERVER['HTTP_HOST']=="192.168.1.254"||$_SERVER['HTTP_HOST']=="192.168.0.254"||$_SERVER['HTTP_HOST']=="192.168.0.103"){
            if(EMAIL_MODEL == 'phpmailer'){
                $CI =& get_instance();
                $mail = $CI->phpmailer_library->load();

                //$mail->SMTPDebug = 3;
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASS;
                $mail->SMTPSecure = SMTP_CRYP;
                $mail->Port = SMTP_PORT;

                //Recipients
                if(empty($from) || is_null($from)){
                    $mail->setFrom(FROM_EMAIL, EMAIL_NAME);
                } else {
                    $mail->setFrom($from, EMAIL_NAME);
                }

                if($_SERVER['HTTP_HOST']=="localhost"||$_SERVER['HTTP_HOST']=="192.168.1.254"||$_SERVER['HTTP_HOST']=="192.168.0.254"||$_SERVER['HTTP_HOST']=="192.168.0.103"){
                    $mail->addAddress(EMAIL_DEV);
                } else {
                    $mail->addAddress($to);
                }

                if(!is_null($replyTo)){
                    $mail->addReplyTo($replyTo);
                }

                $mail->Subject = utf8_decode($subject);

                $mail->MsgHTML( utf8_decode($message) );
                return $mail->Send();
            } elseif (EMAIL_MODEL == 'codeigniter'){

                $config['charset']     = 'iso-8859-1';
                $config['wordwrap']    = TRUE;
                $config['mailtype']    = 'html';
                $config['protocol']    = 'smtp';
                $config['smtp_host']   = SMTP_HOST;
                $config['smtp_user']   = SMTP_USER;
                $config['smtp_pass']   = SMTP_PASS;
                $config['smtp_port']   = SMTP_PORT;
                $config['smtp_crypto'] = SMTP_CRYP;

                $CI =& get_instance();
                $lib = $CI->email;

                $lib->initialize($config);

                if(empty($from) || is_null($from)){
                    $lib->from(FROM_EMAIL);
                } else {
                    $lib->from($from);
                }

                if($_SERVER['HTTP_HOST']=="localhost"||$_SERVER['HTTP_HOST']=="192.168.1.254"||$_SERVER['HTTP_HOST']=="192.168.0.254"||$_SERVER['HTTP_HOST']=="192.168.0.103"){
                    $lib->to(EMAIL_DEV);
                } else {
                    $lib->to($to);
                }


                $lib->subject($subject);
                $lib->message($message);
                $lib->send();

                return $lib->send();

            } elseif(EMAIL_MODEL == 'server') {
                //Configura o tipo de codificação de e-mail
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                //configura o tipo de conteúdo e os caracteres aceitos
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                //Configura o e-mail de origem, configure aqui sempre um e-mail válido do próprio site,
                //evitando que sua mensagem seja bloqueada por sistemas de anti-spam e por erro de SPF
                $headers .= 'From: CPV Engenharia <'.FROM_EMAIL.'>' . "\r\n";
                //Configura e-mail para receber uma cópia da mensagem
                //configura o destinatário caso quem receber a mensagem tente responde-la
                //(Quando o destino responder a mensagem

                if(!is_null($replyTo) && !empty($replyTo)){
                    //ela irá para o e-mail que foi preenchido no formulário)
                    $headers .= 'Reply-To: ' . $replyTo . '' . "\r\n";
                }

                if($_SERVER['HTTP_HOST']=="localhost"||$_SERVER['HTTP_HOST']=="192.168.1.254"||$_SERVER['HTTP_HOST']=="192.168.0.254"||$_SERVER['HTTP_HOST']=="192.168.0.103"){
                    $toFi = '<'.EMAIL_DEV.'>';
                } else {
                    $toFi = '<'.$to.'>';
                }

                return mail($toFi, $subject, $message, $headers);

            }

    }
}