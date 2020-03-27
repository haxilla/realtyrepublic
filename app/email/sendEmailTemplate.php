<?php
use App\models\admin\adminOption;

//Variables needed
// $toEmail=
// $toName=
// $theSubject=
// $sendThis=
// $data=

\Mail::send("$sendThis",$data,
function($message)
use($data,$toEmail,$toName,$theSubject)
   {$message
   ->to($toEmail,$toName)
   ->subject($theSubject);
});
