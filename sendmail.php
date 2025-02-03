<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if(isset($_POST['submitContact']))
{
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $suffix = $_POST["suffix"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $contactnumber = $_POST["contactnumber"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->Username   = 'bileco@example.com';                     //SMTP username
    $mail->Password   = 'qponxqtdbxjpovei';                               //SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bileco@example.com', 'bileco');
    $mail->addAddress('bileco@example.com', 'bileco');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New enquiry - BILECO Form';
    $mail->Body    = '<h3>Hello you got new enquiry</h3>
        <h4>Firstname: '.$firstname.'</h4>
        <h4>Middlename: '.$middlename.'</h4>
        <h4>Lastname: '.$lastname.'</h4>
        <h4>Suffix: '.$suffix.'</h4>
        <h4>Address: '.$address.'</h4>
        <h4>Email: '.$email.'</h4>
        <h4>Contact Number: '.$contactnumber.'</h4>
        <h4>Password: '.$password.'</h4>
        <h4>Confirm Password: '.$confirmpassword.'</h4>
    ';

    if( $mail->send())
    {
        $_SESSION['status'] ="Thank you contact us - Team Bileco";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }
    else
    {
        $_SESSION['status'] ="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }
    

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
else
{
    header('Location: consumercreate.php');
    exit(0);
}
?>