<?php
//get model
Use App\models\core\agtoffice;
//get umid
$umid=request('umid');
//error if none
if(!$umid){
   dd('error-line5-agentFlagCounts.php');}
//agentQuery
$remailAgent=agtoffice::select('propagent_id','remailAgentID')
->where('propagent_id','=',"$umid")
->first();
//error if noe
if(!$remailAgent){
   dd('error-line15-appPath-agentFlagCounts');}
//set remailAgentID
$remailAgentID=$remailAgent['remailAgentID'];
//matchQuery
include(app_path().'/queries/remailAgentIdQuery.php');

//set counts
$flagCount           = $remailAgentIdQuery->where('agentFlag','=','1')
->where('agentConfirmDelete','=','0')->count();
$unFlagCount         = $remailAgentIdQuery->where('agentFlag','=','0')
->where('agentConfirmDelete','=','0')->count();
$clearCount          = $remailAgentIdQuery->where('agentClear','!=',null)
->where('agentConfirmDelete','=','0')->count();
$unClearCount        = $remailAgentIdQuery->where('agentClear','=',null)
->where('agentConfirmDelete','=','0')->count();
$confirmDeleteCount  = $remailAgentIdQuery->where('agentConfirmDelete','=','1')
->count();

//format json
$idArray = array(
  'status'                     => 'success',
  'propagent_id'               => $umid,
  'badgeFlagCount'             => $flagCount,
  'badgeUnFlagCount'           => $unFlagCount,
  'badgeClearCount'            => $clearCount,
  'badgeUnClearCount'          => $unClearCount,
  'badgeConfirmDeleteCount'    => $confirmDeleteCount,
);
//output & exit
echo json_encode($idArray);
exit();

