<?php
//models
Use App\models\core\agtoffice;
//needed for remailAgentID & tempOfficeID
$agtOfficeQuery=agtOffice::where('propagent_id','=',"$thisDup")
->select('tempOfficeID','remailAgentID')
->first();
//other variables
//used to gather specifics on each individual account
$thisAgtFullName   = $getAgent['agtFullName'];
$thisOfficeID      = $getAgent['officeID'];
$thisAgtPhoto      = $getAgent['agtPhoto'];
$thisAgtLogo       = $getAgent['agtLogo'];
$thisStartDate     = $getAgent['startDate'];
$thisExpireDate    = $getAgent['expireDate'];
$thisAgtUname      = $getAgent['agtUname'];
$thisxxAgtUname    = $getAgent['xxAgtUname'];
$thisAgtEmail      = $getAgent['agtEmail'];
$thisRemCreds      = $getAgent['remCreds'];
$thispCreds        = $getAgent['pCreds'];
$thisRemailAgentID = $agtOfficeQuery['remailAgentID'];
$thisTempOfficeID  = $agtOfficeQuery['tempOfficeID'];
//build array
$accountDetails[$thisDup]=[
   'propagent_id'          => $thisDup,
   'agtFullName'           => $thisAgtFullName,
   'officeID'              => $thisOfficeID,
   'agtPhoto'              => $thisAgtPhoto,
   'agtLogo'               => $thisAgtLogo,
   'startDate'             => $thisStartDate,
   'expireDate'            => $thisExpireDate,
   'agtUname'              => $thisAgtUname,
   'xxAgtUname'            => $thisxxAgtUname,
   'agtEmail'              => $thisAgtEmail,
   'remCreds'              => $thisRemCreds,
   'pCred'                 => $thispCreds,
   'remailAgentID'         => $thisRemailAgentID,
   'tempOfficeID'          => $thisTempOfficeID,
   'flyerCount'            => $thisFlyerCount,
   'thisFlyerCountQuery'   => $thisFlyerCountQuery,
];
