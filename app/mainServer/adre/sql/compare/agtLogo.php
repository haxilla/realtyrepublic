<?php
//models
Use App\models\core\propagent;
//currentAgtLogo
if($currentAgtLogo != $finalAgtLogo){
   //update
   propagent::where('id','=',"$mainAccountID")
   ->update([
      'agtLogo'=>$finalAgtLogo,
   ]);
   //agentNote
   $remailEventLog['agentNote'][]='Changed agtLogo from '
   .$currentAgtLogo.' to '.$finalAgtLogo;}
