<?php
//   ***   YOU ARE IN A LOOP          ***
//   ***   $thisID is current value   ***
//   ***   $thisID is merged / $mainAccountID for master


// model
Use App\models\core\agtoffice;

agtoffice::where('propagent_id','=',"$thisID")
->update([
   'mergedWith'   => $mainAccountID,
   'newRemID'     => $mainNewRemID,
]);
