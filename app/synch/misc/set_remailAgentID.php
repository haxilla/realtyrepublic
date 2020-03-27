<?php
Use App\models\core\agtoffice;

//check for remailAgentID
$setRemailAgentID=agtoffice::select('propagent_id')
->whereNull('remailAgentID')
->with(['theAgent'=>function($q){
   $q->select('id','agtFullName');
}])
->get();

foreach($setRemailAgentID as $the){

   foreach($the->theAgent as $t){
      //set variable for script
      $agtFullName=$t->agtFullName;
      //requires $agtFullName
      //returns $agtFullNameClean
      include(app_path().'/functions/cleanup/agtFullName.php');
      //trim and create first & second half
      $agtFirst5 = substr($agtFullNameClean, 0, 5);
      $agtLast5 = substr($agtFullNameClean, -5);
      $remailAgentID=$agtFirst5.$agtLast5;
      //update
      agtoffice::where('propagent_id','=',"$t->id")
      ->update([
         'remailAgentID'=>$remailAgentID,
      ]);
   }
}
