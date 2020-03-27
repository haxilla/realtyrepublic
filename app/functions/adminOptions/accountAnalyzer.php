<?php
use App\models\core\propagent;
use App\models\core\agtoffice;

if($agentID1 && $agentID2){
   //show id of account if both available
   $agentID=$agentID2;
   //both are existing
   $addDistrib=0;
   $addAccount=0;
   //get info
   $agentInfo=propagent::where('id','=',"$agentID")
   ->first();
   $officeInfo=agtoffice::where('propagent_id','=',"$agentID")
   ->first();
}elseif($agentID1 && !$agentID2){
   //set to ID1
   $agentID=$agentID1;
   //no account but has distrib record
   $addDistrib=0;
   $addAccount=1;
   //get info
   $agentInfo=$theList::where('eidx','=',"$agentID")
   ->first();
   $officeInfo=$theList::where('eidx','=',"$agentID")
   ->first();
}elseif(!$agentID1 && $agentID2){
   //set to ID2
   $agentID=$agentID2;
   //no distrib record but has account
   $addDistrib=1;
   $addAccount=0;
   $lastArea=null;
   //get info
   $agentInfo=propagent::where('id','=',"$agentID")
   ->first();
   $officeInfo=agtoffice::where('propagent_id','=',"$agentID")
   ->first();
}
