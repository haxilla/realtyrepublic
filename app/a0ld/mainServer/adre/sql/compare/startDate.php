<?php
//models
Use App\models\core\propagent;
//startDate
if($currentStartDate>$finalStartDate){
   //update
   propagent::where('id','=',"$mainAccountID")
   ->update([
      'startDate'=>$finalStartDate,
   ]);
   //agentNote
   $remailEventLog['agentNote'][]='Changed StartDate from '
   .$currentStartDate.' to '.$finalStartDate;}
