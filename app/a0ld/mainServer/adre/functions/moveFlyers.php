<?php

if($theFlyerCount){
   // sql
   include(app_path().'/adre/sql/update/moveFlyersMergeSQL.php');
   //sqlreport
   $remailEventLog['sqlReport'][$moveThis]['flyersMoved']=$theFlyerCount;
   // add note to agent account
   $remailEventLog['agentNote'][]='Moved '
   .$theFlyerCount.' Flyers from '.$moveThis
   .' Into Account '.$mainAccountID;}
