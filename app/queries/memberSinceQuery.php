<?php
// get model
use App\models\core\propagent;
//set date frame
$theDate=\Carbon\Carbon::today()->subDays(30);
//query
$memberSince=propagent::select('startDate','agtFullName',
  'id','officeID','agtPhoto')
->whereHas('theStats',function($q)use($theDate){
  $q->select('propagent_id','xLastDeliveryDate')
  ->where('xLastDeliveryDate','>',$theDate);
})
->with(['theAgentMeta'=>function($q){
  $q->select('newRemID','propagent_id');
}])
->with(['theAgentCleanup'=>function($q){
  $q->select('newRemID','propagent_id');
}])
->with(['theAgtOffice'=>function($q){
  $q->select('officeID','propagent_id');
}])
->whereNotNull('startDate')
->whereNotNull('agtPhoto')
->groupBy('id')
->orderBy('startDate')
->take(36)
->get();
/* starting with stats example
$memberSince=propflyerstat::select('xLastDeliveryDate','propagent_id')
->with(['theAgent'=>function($q){
	$q->select('agtFullName','agtPhoto','officeID','startDate','id');
}])
->with(['theAgentMeta'=>function($q){
  $q->select('newRemID','propagent_id');
}])
->with(['theAgentCleanup'=>function($q){
	$q->select('newRemID','propagent_id');
}])
->where('xLastDeliveryDate','>',$theDate)
->groupBy('propagent_id')
->take(12)
->get();
dd($memberSince);
*/

/* working raw SQL join statement example
SELECT DISTINCT agtFullName,startDate,id,agtPhoto FROM propagents
LEFT JOIN propflyerstats ON propagents.id
WHERE propagents.id=propflyerstats.propagent_id
AND xLastDeliveryDate > '2019-03-01'
AND agtPhoto IS NOT NULL
ORDER BY startDate;

/* make query to check theAgentCleanup
@if($the->theAgent->theAgentCleanup)
  <img 
  src='/agentPhotos/{{$the->theAgent->theAgentCleanup
    ->newRemID}}/{{$the->theAgent->agtPhoto}}'
  class="carouselAgentImg">
@else
  <img
  src='http://www.realtyemails.com/HQoffice/{{$the->theOffice
    ->officeID}}/{{$the->theAgent->agtPhoto}}'
    class="carouselAgentImg">
@endif