<?php
//set mlsName
if($listName=='GLVAR'){
  $mlsName='GLVAR';
}elseif(strpos($listName,"azphx")){
  $mlsName='ARMLS';
}else{
  $mlsName=$listName;}

if($listName=='glvar'){
	$mlsID=$theList['MLSID'];
	$officeID=$theList['OfficeMLSID'];
	$eidx='glvar_'.$theList['eidx'];
}else{
	$mlsID=$theList['agtMlsID'];
	$officeID=$theList['officeID'];
	$eidx=$theList['eidx'];}

//if no mlsID found set to eidx
if(!$mlsID){
	$mlsID=$eidx;}

//prefer area to be listed as AZNAZ or AZSAZ
//but list is only NAZ or SAZ
if(strpos($mlsID,"NAZ")!==false
||strpos($mlsID,"SAZ")!==false){
	$mlsID='AZ'.$mlsID;}