<?php

use App\models\core\propagent;

//credit based account = 5
propagent::where('id','=',"$umid")
->update([
    'remCreds'     => $updateRemCreds,
]);

//send Credits Added to account email
$data=[
  'addCredit'       => $addCredit,
  'currentRemCreds' => $currentRemCreds,
  'updateRemCreds'  => $updateRemCreds,
  'desc'            => $desc
];

$theSubject="RealtyEmails Purchase - $desc";
\Mail::send('emails.purchases.addCredits',$data,
  function($message)
  use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
    $message->to($toEmail,$toName)
    ->from($fromEmail,$fromName)
    ->subject($theSubject);
});
