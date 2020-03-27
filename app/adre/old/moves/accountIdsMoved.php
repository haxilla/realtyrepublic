<?php
$accountIdsMoved=[];
foreach($dupCheck as $the){
   if($the != $mainAccountID){
      $accountIdsMoved[]=$the;
   }
}
//log
$remailEventLog['accountsMoved']['accountIdsMoved']=$accountIdsMoved;
