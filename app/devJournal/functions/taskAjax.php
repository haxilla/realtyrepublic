<?php

//set variables
$newTaskID=null;
$taskID=request('taskID');
$taskType=request('taskType');
$taskSection=request('taskSection');
$taskDeleteSoft=request('taskDeleteSoft');
$taskDeleteRestore=request('taskDeleteRestore');
$taskDesc=request('taskDesc');
$taskComplete=request('taskComplete');
$taskCompleteRestore=request('taskCompleteRestore');
$taskSnooze=request('taskSnooze');
$taskUnSnooze=request('taskUnSnooze');
$taskauthlevel=request('taskauthlevel');
$taskBump=request('taskBump');
$taskSticky=request('tasksticky');
$taskFlag=request('taskFlag');
$taskUnflag=request('taskUnflag');
$listRef=request('listRef');

//if markDone with taskID mark complete
if($taskComplete && $taskID){
	include('taskComplete.php');}

if($taskCompleteRestore && $taskID){
	include('taskCompleteRestore.php');}

// if taskDesc with no taskID, add new
if($taskDesc && !$taskID){
	include('taskAdd.php');}

//if softDelete - mark & exit
if($taskDeleteSoft && $taskID){
	include('taskDeleteSoft.php');}

if($taskDeleteRestore && $taskID){
	include('taskDeleteRestore.php');}

//if taskDesc w/ taskID supplied - edit
if($taskDesc && $taskID){
	include('taskEdit.php');}

if($taskSection && $taskID && $listRef){
	include('taskSection.php');}

if($taskType && $taskID && $listRef){
	include('taskType.php');}

if($taskSnooze && $taskID){
	include('taskSnooze.php');}

if($taskUnSnooze && $taskID){
	include('taskUnSnooze.php');}

if($taskauthlevel && $taskID){
	include('taskauthlevel.php');}

if($taskBump && $taskID){
	include('taskBump.php');}

if($taskSticky && $taskID){
	include('taskSticky.php');}

if($taskFlag && $taskID){
	include('taskFlag.php');}

if($taskUnflag && $taskID){
	include('taskUnflag.php');}