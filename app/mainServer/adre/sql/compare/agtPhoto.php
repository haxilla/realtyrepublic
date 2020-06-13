<?php
//models
Use App\models\core\propagent;
//currentAgtPhoto
if($currentAgtPhoto != $finalAgtPhoto){
   //update
   propagent::where('id','=',"$mainAccountID")
   ->update([
      'agtPhoto'=>$finalAgtPhoto,
   ]);
   //agentNote
   $remailEventLog['agentNote'][]='Changed AgtPhoto from '
   .$currentAgtPhoto.' to '.$finalAgtPhoto;}
