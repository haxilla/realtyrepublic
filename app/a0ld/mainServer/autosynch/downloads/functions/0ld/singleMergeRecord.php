<?php
//models
Use App\models\core\propagentcleanup;
//match
$matchThese = array('propagent_id' =>$mergedWith);
//sql
propagentcleanup::firstOrCreate($matchThese,[
   'propagent_id' => $mergedWith,
   'mergedWith'   => $thisID,
   'newRemID'     => $the->newRemID,
   'accountType'  => 'merge',
]);
