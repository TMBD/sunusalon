<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

// $email_body = '
// <h3>Bonjour Assy DIALLO </h3>
// <p>Vous venez de vous inscrire dans notre plateforme de prise de rendez-vous <b>suñusalon</b>.</p>
// <p>Voici le code d\'activation de votre compte : </p>
// <p style="color:blue;"><h4><b><em>123544</em></b></h4></p>
// <p>
//     <em>
//         Merci ! <br/>
//         <small>Ce mail a été autogénéré, merci de ne pas y repondre !</small>
//     </em>
// </p>
// ';

// $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
//     try {
//         //Server settings
//         $mail->SMTPDebug = 3;                                 // Enable verbose debug output
//         $mail->isSMTP();                                      // Set mailer to use SMTP
//         //$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
//         $mail->Host = 'smtp.gmail.com'; //gethostbyname('smtp.gmail.com');//'smtp.gmail.com';
//         $mail->SMTPAuth = true;                               // Enable SMTP authentication
//         //$mail->Username = 'user@example.com';                 // SMTP username
//         $mail->Username = 'sunusalon.service@gmail.com';  //'thiernomb.diallo@gmail.com';
//         $mail->Password = 'sunusalonservicesunusalonservice';  //'tmbd287954711gmailpro';                           // SMTP password
//         $mail->SMTPSecure = 'ssl';  //'tls';                            // Enable TLS encryption, `ssl` also accepted
//         $mail->Port = 465;  //465 587;                                    // TCP port to connect to
    
//         $mail->SMTPOptions = array(
//             'ssl' => array(
//                 'verify_peer' => false,
//                 'verify_peer_name' => false,
//                 'allow_self_signed' => true
//             )
//         );

//         //Recipients
//         $mail->setFrom('sunusalon.service@gmail.com', 'sunusalon');
//         $mail->addAddress('thierstardiallo15@gmail.com', 'TMBD');     // Add a recipient
//         //$mail->addAddress('ellen@example.com');               // Name is optional
//         //$mail->addReplyTo('sunusalon.service@gmail.com', 'sunusalon');  //emailpersoThier
//         //$mail->addCC('cc@example.com');
//         //$mail->addBCC('bcc@example.com');
    
//         //Attachments
//         // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
//         //Content
//         $mail->isHTML(true);                                  // Set email format to HTML
//         $mail->Subject = 'Activation de compte sunusalon';
//         $mail->Body    = $email_body;   //'This is the HTML message body <b>in bold!</b>';
//         $mail->AltBody = strip_tags($email_body);
    
//         $mail->send();
//         echo 'Message has been sent';
//     } catch (Exception $e) {
//         echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
//     }












    ////////////////////////////////////////////////////////////////////////////////////////////

function sent_code_to_user($user_email, $prenom, $nom, $code, $password, $user_type){
    $SUNUSALON_EMAL = 'sunusalon.service@gmail.com';
    $SUNUSALON_PWD =  'sunusalonservicesunusalonservice';

    $email_body = get_email_body($prenom, $nom, $code, $password, $user_type);

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        //$mail->SMTPDebug = 3;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        //$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->Host = 'smtp.gmail.com'; //gethostbyname('smtp.gmail.com');//'smtp.gmail.com';
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        //$mail->Username = 'user@example.com';                 // SMTP username
        $mail->Username = $SUNUSALON_EMAL;  //'thiernomb.diallo@gmail.com';
        $mail->Password = $SUNUSALON_PWD;  //'tmbd287954711gmailpro';                           // SMTP password
        $mail->SMTPSecure = 'ssl';  //'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;  //465 587;                                    // TCP port to connect to
    
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom($SUNUSALON_EMAL, 'sunusalon');
        $mail->addAddress($user_email, $prenom.' '.$nom);   //$mail->addAddress('thierstardiallo15@gmail.com', 'TMBD');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('sunusalon.service@gmail.com', 'sunusalon');  //emailpersoThier
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Activation de compte sunusalon';
        $mail->Body    = $email_body;   //'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = strip_tags($email_body);
    
        if($mail->send()) return true;
        else return false;
        // $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }

}


function get_email_body($prenom, $nom, $code, $password, $user_type){
    if($user_type == 'employe')
        $email_body = '
            <h3>Bonjour '.$prenom.' '.$nom.' </h3>
            <p>Vous venez d\'être ajouté dans notre plateforme de prise de rendez-vous <b>suñusalon</b>.</p>
            <p>Voici votre mot de passe et le code d\'activation de votre compte : </p>
            <p style="color:blue;"><h4> Mot de passe : <b><em>'.$password.'</em></b></h4></p>
            <p style="color:blue;"><h4> Code : <b><em>'.$code.'</em></b></h4></p>
            <p>
                <em>
                    Merci ! <br/>
                    <small>Ce mail a été autogénéré, merci de ne pas y repondre !</small>
                </em>
            </p>
            ';
    else 
        $email_body = '
            <h3>Bonjour '.$prenom.' '.$nom.' </h3>
            <p>Vous venez de vous inscrire dans notre plateforme de prise de rendez-vous <b>suñusalon</b>.</p>
            <p>Voici le code d\'activation de votre compte : </p>
            <p style="color:blue;"><h4><b><em>'.$code.'</em></b></h4></p>
            <p>
                <em>
                    Merci ! <br/>
                    <small>Ce mail a été autogénéré, merci de ne pas y repondre !</small>
                </em>
            </p>
            ';

    return $email_body;
}
