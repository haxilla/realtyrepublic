<?php

//models
//changes
$changeLogModel="App\\rets\\$retsSystem\\$mlsName\\".
"compare\\models\\$retsClass".'_changelog';
//history
$historyLogModel="App\\rets\\$retsSystem\\$mlsName\\".
"compare\\models\\$retsClass".'_history';

//set log
$changeLogPath="$retsClass/log/changeLog.php";

//homes
//set defaults
$backOnMarketCount=0;
$underContractCount=0;
$closedSaleCount=0;
$closedLeaseCount=0;
$historyCount=0;
$otherStatusCount=0;
$lowerCount=0;
$raiseCount=0;