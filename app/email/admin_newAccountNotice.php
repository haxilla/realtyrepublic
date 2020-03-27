<?php 
//get URL
include(app_path().'/functions/fromURL.php');
//send admin email
$toEmail       = 'realtyemails@gmail.com';
$toName        = "Chris Mistretta";
$theSubject    = 'New Trial Account Request!';
$data          = [
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtFullName'     => $agtFirst.' '.$agtLast,
   'agtEmail'        => $agtEmail,
   'agtMainPhone'    => $agtMainPhone,
   'agtWebsite'      => $agtWebsite,
   'agtDesigs'       => $agtDesigs,
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress1,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip,
   'key'             => $shortKey,
   'fromURL'         => $fromURL,
   'amt'             => $purchaseAmt,
];
//admin notice
\Mail::send('emails.admin.newTrialRequest',
   $data, function($message) use ($data,$toEmail,$toName,$theSubject){
   $message->to($toEmail,$toName)
   ->subject($theSubject);
});