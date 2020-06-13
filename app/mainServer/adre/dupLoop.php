<?php

//   **   DELETE LOOP               **  //
//   **   YOU ARE INSIDE A LOOP     **  //
//   ** Current Record is $thisDup  **  //
//////////////////////////////////////////

Use App\models\core\propagent;
Use App\models\core\agtoffice;
Use App\models\core\propflyer;

//propagent, agtoffice, propflyer + variable setting
include(app_path().'/adre/queries/deleteDupLoop/deleteDupLoopQueries.php');
//errors
include(app_path().'/adre/errorHandle/errorList.php');
//mainAccountID files
include(app_path().'/adre/accountQueries/earliestAccount.php');
include(app_path().'/adre/accountQueries/latestAccount.php');
include(app_path().'/adre/accountQueries/lastLoginAccount.php');
include(app_path().'/adre/accountQueries/mostFlyersAccount.php');
include(app_path().'/adre/accountQueries/mostRemCredsAccount.php');
//agtPhoto
include(app_path().'/adre/remchecks/agtPhotoScrape.php');
//agtLogo
include(app_path().'/adre/remchecks/agtLogoScrape.php');
//status Array
include(app_path().'/adre/remchecks/accountStatus.php');
//saveImagesLog
include(app_path().'/adre/logs/saveImagesLog.php');
//statusLog
$dupLoop['allAccounts'][$thisID]['status']=$saveStatusLog[$thisID]['status'];
//imagesLog
$dupLoop['allAccounts'][$thisID]['images']=$saveImagesLog[$thisID]['images'];
//photoNotesLog
$dupLoop['allAccounts'][$thisID]['remchecks']['agtPhotoNotes']=$agtPhotoNotes;
//LogoNotesLog
$dupLoop['allAccounts'][$thisID]['remchecks']['agtLogoNotes']=$agtLogoNotes;
//accountDetailsLog
include(app_path().'/adre/logs/accountDetailsLog.php');
$remailEventLog=$dupLoop;

