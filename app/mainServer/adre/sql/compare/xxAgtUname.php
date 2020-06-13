<?php
//models
Use App\models\core\propagent;
//currentUsername
if($currentUsername != $finalUsername){
   //update
   propagent::where('id','=',"$mainAccountID")
   ->update([
      'xxAgtUname' => $finalUsername,
      'agtUname'   => $finalUsername,
      'agtPswd'    => $finalAgtPswd,]);
   //agentNote
   $remailEventLog['agentNote'][]='Changed Username from '
   .$currentUsername.' to '.$finalUsername;}
