<?php

use App\models\admin\newaccessrequest;

newaccessrequest::where('id','=',"$trialID")
->update([
   'agtMlsID'     => $agtMlsID,
   'officeID'     => $officeID,
   'agtBoard'     => $agtBoard,
   'agtCounty'    => $agtCounty,
   'areaList'     => $areaList,
]);
