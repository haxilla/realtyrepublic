<?php

$thisModel=NULL;
$thisTotal=NULL;
//variables
$retsSystem=$getRets['retsSystem'];
$mlsName=$getRets['mlsName'];
//credentials
$retsURL=$getRets['retsURL'];
$retsUname=$getRets['retsUname'];
$retsPswd=$getRets['retsPswd'];
$retsVersion=$getRets['retsVersion'];
$mainTable=$mlsName.'_'.$thisSynch;
$metaTable=$mainTable.'_meta';
$synchTable=$mainTable.'_synch';
$backupTable=$mainTable."_backup";
//models
$mainModel="App\\rets\\$retsSystem\\$mlsName\\synch\\models\\$thisSynch";
$backupModel=$mainModel.'_backup';
$synchModel=$mainModel.'_synch';

//count
$mainCount=$mainModel::count();
$backupCount=$backupModel::count();

//theStatus is pending by default
//overwritten when changed
$theStatus='Pending';