<?php

//back on market
if(strpos($the->statusOld,'Under')!==false 
&& strpos($the->statusNew,'Active')!==false){
	$backOnMarketCount++;
	$newStatus='backOnMarket';
//under contract
}else if(strpos($the->statusOld,'Active')!==false 
&& strpos($the->statusNew,'Under')!==false){
	$underContractCount++;
	$newStatus='underContract';
// changed from undercontract-show 
// to undercontract-noshow
}elseif(strpos($the->statusNew,'Under')!==false){
	$underContractCount++;
	$newStatus='underContract';
//closed sale
}elseif(strpos($the->statusNew,'Sold')!==false){
	$closedSaleCount++;
	$newStatus='sold';
//closed lease
}elseif(strpos($the->statusNew,'Leased')!==false){
	$closedLeaseCount++;
	$newStatus='leased';
}elseif(strpos($the->statusNew,'History')!==false){
	$historyCount++;
	$newStatus='history';
}else{
	$otherStatusCount++;}
