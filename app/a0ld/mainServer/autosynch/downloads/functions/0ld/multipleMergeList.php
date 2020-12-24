<?php
//models
Use App\models\core\propagentcleanup;
//explode into singles
$mergeMultipleList = explode(",", $mergedWith);
//loop
foreach($mergeMultipleList as $merged){
   //sql
   $matchThese = array('propagent_id' =>$merged);
   propagentcleanup::firstOrCreate($matchThese,[
      'propagent_id' => $merged,
      'mergedWith'   => $thisID,
      'newRemID'     => $the->newRemID,
      'accountType'  => 'merge',]);}
