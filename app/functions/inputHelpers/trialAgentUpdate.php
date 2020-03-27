<?php

use App\models\admin\newaccessrequest;

newaccessrequest::where('id','=',"$trialID")
->update([
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtWebsite'      => $agtWebsite,
   'agtFullName'     => $agtFirst.' '.$agtLast,
   'agtEmail'        => $agtEmail,
   'agtMainPhone'    => $agtMainPhone,
   'agtWebsite'      => $agtWebsite,
   'agtDesigs'       => $agtDesigs,
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress1,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip
]);
