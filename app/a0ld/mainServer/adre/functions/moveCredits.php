<?php

//mergeAccount remcreds->mainAccount
if($theRemCredCount||$thePcredCount){
   // sql
   include(app_path().'/adre/sql/update/moveCreditSQL.php');
   // note
   $remailEventLog['sqlReport'][$moveThis]['remCredsMoved']=$theRemCredCount;
   $remailEventLog['sqlReport'][$moveThis]['pCredsMoved']=$thePcredCount;
   //remcred
   if($theRemCredCount){
      $remailEventLog['agentNote'][]='Moved '
      .$theRemCredCount.' RemCreds from '.$moveThis
      .' Into Account '.$mainAccountID;}
   if($thePcredCount){
      $remailEventLog['agentNote'][]='Moved '
      .$thePcredCount.' pCreds from '.$moveThis
      .' Into Account '.$mainAccountID;}
}
