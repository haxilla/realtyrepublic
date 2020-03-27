<?php

use App\models\core\propagent;
use App\models\core\agtoffice;

propagent::where('id','=',"$umid")
->update([
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtFullName'     => $agtFirst.' '.$agtLast,
   'agtEmail'        => $agtEmail,
   'agtMainPhone'    => $agtMainPhone,
   'agtWebsite'      => $agtWebsite,
   'agtDesigs'       => $agtDesigs,
   'agtReview'       => 0,
   'agtReviewDate'   => \Carbon\Carbon::now(),
]);

agtoffice::where('propagent_id','=',"$umid")
->update([
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress1,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip
]);
