<?php
//model
use App\models\core\propagentmeta;
//log Admin
$adminID=Auth::guard('admin')->user()->id;
//remStatus
include(app_path().'/adre/functions/buildRemStatus.php');
//matchThese for firstOrCreate
$matchThese = array('propagent_id' =>$mainAccountID);
//create with newRemailAgentID
$propagentmeta=propagentmeta::updateOrCreate($matchThese,
[
   'propagent_id'       => $mainAccountID,
   'LicNumber'          => $LicNumber,
   'LicStatus'          => $thisLicStatus,
   'EmployerLicNumber'  => $EmployerLicNumber,
   'remailAgentID'      => $mainRemailAgentID,
   'newRemID'           => $mainNewRemID,
   'newRemOfficeID'     => $mainTempOfficeID,
   'mergedWith'         => $mergedWithSaves,
   'agtPhotoCheck'      => $agtPhotoCheck,
   'agtLogoCheck'       => $agtLogoCheck,
   'adminID'            => $adminID,
   'armlsAgtID'         => $thisArmlsAgtID,
   'armlsOfficeID'      => $thisArmlsOfficeID,
   'eidx'               => $thisEidx,
   'remStatus'          => $remStatus,
   'hasAgtPhoto'        => $hasAgtPhoto,
   'hasAgtLogo'         => $hasAgtLogo,
   'agtPhotoError'      => $agtPhotoError,
   'agtLogoError'       => $agtLogoError,
]);
