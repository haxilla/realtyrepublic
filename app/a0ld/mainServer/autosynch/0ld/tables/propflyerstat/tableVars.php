<?php

//change these
$tableMain='agtoffice';
$tableOld='emailagents';

//set vars
$tableMains=$tableMain.'s';
$tableBackup=$tableMain.'Backup';
$tableSynch=$tableMain.'Synch';
$tableFed=$tableMain.'_federated';

//for single synch
if($synchType=='synchOne'){
	$partialComplete=1;}
