<?php

//set model
$homeHistory='App\rets\models\\'.$mlsName.'homes_history';

$checkHistory=$homeHistory::where('datemodMatrix','=',$the->datemodMatrix)
->first();

if($changeType=='Removed'){
	$currentPrice=$the->priceOld;
	$currentStatus='Removed';
}else{
	$currentPrice=$the->priceNew;
	$currentStatus=$the->statusNew;}

if($the->idmatrixOld){
	$idMatrix=$the->idmatrixOld;
}else{
	$idMatrix=$the->idmatrixNew;}

if($the->mlsNumNew){
	$mlsNumber=$the->mlsNumNew;
}else{
	$mlsNumber=$the->mlsNumOld;}


if(!$checkHistory){
	$homeHistory::create([
		'logID'			=> $logID,
		'mlsName'		=> $mlsName,
		'mlsNumber'		=> $mlsNumber,
		'matrixID'		=> $idMatrix,
		'datemodMatrix'	=> $the->datemodMatrix,
		'changeType'	=> $changeType,
		'currentPrice'	=> $currentPrice,
		'currentStatus'	=> $currentStatus,
	]);}