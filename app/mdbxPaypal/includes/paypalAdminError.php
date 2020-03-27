<?php

$toEmail='realtyemails@gmail.com';
$toName='Realty Emails';
$fromEmail='support@realtyrepublic.com';
$fromName='RealtyEmails Admin';

\Mail::send('emails.admin.errorNotice',$data,
function($message)
    use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
    $message->to($toEmail,$toName)
    ->from($fromEmail,$fromName)
    ->subject($theSubject);
});

// exit script but notify paypal
// transmission was success
header("HTTP/1.1 200 OK");
exit();
