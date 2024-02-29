<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($dataMail){

$mail = new PHPMailer(true);

try {
                        
    $mail->isSMTP();   
    $mail->Host       = 'localhost';
    $mail->Port       = 1025; 
    $mail->SMTPAuth   = false;
    $mail->SMTPSecure = false;
   
    $mail->setFrom('from@sender.com', 'Mailer');      
    $mail->addAddress($dataMail['email'], $dataMail['name']);
    $mail->addReplyTo('from@sender.com', 'Mailer');


    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = $dataMail['subject'];
    $mail->Body    = $dataMail['body'];
    $mail->AltBody = $dataMail['altBody'];

    $mail->send();
    return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    flash('ErrorRegisterInUser', " مشکلی پیش آمده لطفا جهت فعال سازی حساب خود با پشتیبانی در تماس باشید ", "alert alert-danger");

}
}