<?php

// defaults
$redirect=null;
$reload=0;
$markedBy=$adminID;

// *********************************
// taskSection = where to move to
// *********************************
if($taskSection=="Tip"){
	$redirect="Tip";
	$taskModel="devtip";
	$desc='tipDesc';
}elseif($taskSection=="Excuse"){
	$redirect="Excuse";
	$taskModel="devexcuse";
	$desc='excuseDesc';
}else{
	$redirect="Task";
	$taskModel="devtask";
	$desc="taskDesc";}

//section
if(!$oldSection){
	$oldSection="none";}
	
//type
if(!$taskType){
	$taskType="New";}