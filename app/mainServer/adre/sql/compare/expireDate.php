<?php
//models
Use App\models\core\propagent;
//expireDate
if($currentExpireDate<$finalExpireDate){
   //update
   propagent::where('id','=',"$mainAccountID")
   ->update([
      'expireDate'=>$finalExpireDate,]);
   //agentNote
   $remailEventLog['agentNote'][]='Changed ExpireDate from '
   .$currentExpireDate.' to '.$finalExpireDate;}
