<?php
Use App\models\core\propagent;

$appPrefix = 'App\models\distro';
$theList=$appPrefix.'\\'.$areaList;

//check dups
$dup=$theList::where('agtEmail','=',"$agtEmail")
->first();
//error if found
if($dup){

   $theList::where('agtEmail','=',"$agtEmail")
   ->update([
      'agtEmail'           => $agtEmail,
      'agtFirst'           => $agtFirst,
      'agtLast'            => $agtLast,
      'agtFullName'        => $agtFirst.' '.$agtLast,
      'officeName'         => $officeName,
      'officeAddress1'     => $officeAddress1,
      'officeCity'         => $officeCity,
      'officeState'        => $officeState,
      'officeZip'          => $officeZip,
      'agtMainPhone'       => $agtMainPhone,
   ]);

}else{

   //add to distribution list
   $new=$theList::create([
   'agtEmail'           => $agtEmail,
   'agtFirst'           => $agtFirst,
   'agtLast'            => $agtLast,
   'agtFullName'        => $agtFirst.' '.$agtLast,
   'officeName'         => $officeName,
   'officeAddress1'     => $officeAddress1,
   'officeCity'         => $officeCity,
   'officeState'        => $officeState,
   'officeZip'          => $officeZip,
   'agtMainPhone'       => $agtMainPhone,]);

   //set variables
   $id=$new->id;
   $eidx=$areaList.'x'.$id.'x';

   //set to 0 once its added
   $addDistrib=0;

   //add eidx to record
   $theList::where('id','=',"$id")
   ->update([
      'eidx'=>$eidx
   ]);

   $newID=$newID->id;

   propagent::where('id','=',"$newID")
   ->update([
      'eidx'=>$eidx,
   ]);

}



