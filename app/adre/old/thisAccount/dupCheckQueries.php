<?php
//models
Use App\models\core\propagent;
Use App\models\core\propflyer;
//getAgent Query
$getAgent=propagent::select('startDate','expireDate','remCreds',
'lastLogin','accountType','agtFullName','agtPhoto','agtLogo','officeID',
'agtUname','xxAgtUname','agtEmail','remCreds','pCreds')
->where('id','=',"$thisDup")
->first();
//thisFlyerCount
$thisFlyerCount=propflyer::where('propagent_id','=',"$thisDup")
->count();
//thisFlyerCountQuery
$thisFlyerCountQuery=propflyer::where('propagent_id','=',"$thisDup")
->select('id','propagent_id')
->get();

