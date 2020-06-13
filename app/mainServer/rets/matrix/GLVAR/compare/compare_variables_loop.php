<?php

$loopCount++;

//determine status change type if different
if($the->statusNew && $the->statusOld 
&& $the->statusOld != $the->statusNew){
	include("$retsClass/variables/statusCount_loop.php");}

if($retsClass=="Homes"){

	//set currentPrice
	if($the->priceNew){
		$currentPrice=$the->priceNew;
	}elseif($the->priceOld){
		$currentPrice=$the->priceOld;
	}else{
		dd("error-line48-$mlsName/compare_variables_loop");}}

if($retsLoop=='homePrice'){
	//changeType is Lowered or Raised
	if($the->priceOld > $the->priceNew){
		$changeType="Lowered";
		$lowerCount++;
	}else{
		$changeType="Raised";
		$raiseCount++;}}

