<?php
//use this page to keep consistant - flyerLanding - adminFlyerCheck

//add security check check
include(app_path().'/flyerVariables/existingFlyerCheck.php');
//propInfo,agentInfo,officeInfo, etc
include(app_path() . '/queries/mdbxMainQueries.php');
//created variables from above queries
include(app_path() . '/flyerVariables/mdbxSetVars.php');
//finding fromURL from variables set at above queries
include(app_path() . '/flyerVariables/mdbxfromURL.php');
//count Bullets
include(app_path() . '/flyerVariables/mdbxCountBullets.php');
//enc variables
$enc = Crypt::encrypt([
   'ufid'=>$idFly,
   'umid'=>$umid,
   'cid'=>'mdbxFlyerBranch',
   'eid'=>'0',
   'emArea'=>'0',
   'template'=>$theTemplate,
   'toEmail'=>'screenClick'
]);

return view('mdbxMember.fullPages.mdbxLanding', [
   'propInfo'           => $propInfo,
   'officeID'           => $officeID,
   'idFly'              => $idFly,
   'graphic_words'      => $graphic_words,
   'graphic_textcolor'  => $graphic_textcolor,
   'graphic_style'      => $graphic_style,
   'flyer_background'   => $flyer_background,
   'hlGraphic'          => $hlGraphic,
   'theTemplate'        => $theTemplate,
   'bullets_LH'         => $bullets_LH,
   'theHeadline'        => $theHeadline,
   'display'            => 'screen',
   'showLight'          => $showLight,
   'fromURL1'           => $fromURL1,
   'fromURL2'           => $fromURL2,
   'fromURL3'           => $fromURL3,
   'agtPhoto'           => $agtPhoto,
   'agtLogo'            => $agtLogo,
   'zipDir'             => $zipDir,
   'mlsDir'             => $mlsDir,
   'totalPhotos'        => $totalPhotos,
   'enc'                => $enc,
]);
