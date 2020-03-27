<?php

//change these
$tableMain='propagent';
$tableOld='emailagents';

//set vars
$tableMains=$tableMain.'s';
$tableBackup=$tableMain.'Backup';
$tableSynch=$tableMain.'Synch';
$tableFed=$tableMain.'_federated';

//for single synch
if($synchType=='synchOne'){
	$partialSynch=1;
	$partialNext='agtoffice';}
