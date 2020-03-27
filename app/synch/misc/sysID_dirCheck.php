<?php

$noSysid=archiveFlyer::select('ufid','zipDir','mlsDir')
->whereNull('sysid')
->orWhereNull('zipDir')
->orWhereNull('mlsDir')
->get();

include(app_path().'/members/keygens/mdbxGenPswd.php');

foreach($noSysid as $the){
   //create sysid
   $digits=rand(10,20);
   $genPswd=generatePassword($digits);
   $sysid=$genPswd;
   //update
   if(!$the->sysid){
      archiveFlyer::where('ufid','=',"$the->ufid")
      ->update([
         'sysid'=>$sysid
      ]);
   }
   //fix zipDir
   if(!$the->zipDir){
   archiveFlyer::where('ufid','=',"$the->ufid")
      ->update([
         'zipDir'=>$sysid
      ]);
   }
   //fix mlsDir
   if(!$the->mlsDir){
      archiveFlyer::where('ufid','=',"$the->ufid")
      ->update([
         'mlsDir'=>$sysid
      ]);
   }
}
