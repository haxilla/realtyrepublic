<?php
//variable to suit json reply for ratio is ratioUpdate
$ratioUpdate=$ratio;

//set array
$idArray = array(
   'status'              => $status,
   'totalFlyerRecords'   => $totalFlyerRecords,
   'thisTotalPhotos'     => $thisTotalPhotos,
   'thisPhotoCount'      => $thisPhotoCount,
   'remoteURL'           => $remoteURL,
   'localURL'            => $localURL,
   'localPath'           => $localPath,
   'existCheck'          => $existCheck->toDateTimeString(),
   'ratioUpdate'         => $ratioUpdate,
   'width'               => $width,
   'notFound'            => $notFound,
   'localFound'          => $localFound,
   'remoteFound'         => $remoteFound,
   'photoID'             => $t->photoID,);
//echo
echo json_encode($idArray);
//exit
exit();
