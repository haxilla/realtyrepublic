<?php
$inDistro=0;
$inList=null;
$thisEidx=null;
$thisArmlsOfficeID=null;
//get queries
Use App\models\distro\remDistroCheck;

//run loop
if(array_key_exists('Invalid', $checkEmails)){
   foreach($checkEmails['Invalid'] as $the){
      //checks if in list
      include(app_path().'/adre/queries/distroQueries.php');
      //  **  if found add
      //  **  azphxmetro
      if($azphxmetro->count()){
         //inDistro
         $inDistro = 1;
         $inList          = 'azphxmetro';
         $thisEidx            = $azphxmetro->first()->eidx;
         $thisArmlsOfficeID   = $azphxmetro->first()->officeID;
         $thisArmlsAgtID      = $azphxmetro->first()->agtMlsID;
         //details
         $distroCheck[$the]['distro']['details']=[
            'list'            =>'azphxmetro',
            'eidx'            => $azphxmetro->first()->eidx,
            'armlsOfficeID'   => $azphxmetro->first()->officeID,
            'armlsAgtID'      => $azphxmetro->first()->agtMlsID,
            'checkDate'       => \Carbon\Carbon::now(),
            'entryDate'       => $azphxmetro->first()->entryDate,
            'xLastHit'        => $azphxmetro->first()->xLastHit,];

         //insert if ok
         $matchThese = array('theEmail' =>$the);
         //create with newRemailAgentID
         remDistroCheck::firstOrCreate($matchThese,
         [
            'theEmail'     => $the,
            'theList'      => 'azphxmetro',
            'propagent_id' => $mainAccountID,
            'eidx'         => $thisEidx,
            'emailStatus'  => 'Invalid',]);}

      //  **  azphxne
      if($azphxne->count()){
         //inDistro
         $inDistro=1;
         $inList              = 'azphxne';
         $thisEidx            = $azphxne->first()->eidx;
         $thisArmlsOfficeID   = $azphxne->first()->officeID;
         $thisArmlsAgtID      = $azphxne->first()->agtMlsID;
         //details
         $distroCheck[$the]['distro']['details']=[
            'list'            =>'azphxne',
            'eidx'            => $azphxne->first()->eidx,
            'armlsOfficeID'   => $azphxne->first()->officeID,
            'armlsAgtID'      => $azphxne->first()->agtMlsID,
            'checkDate'       => \Carbon\Carbon::now(),
            'entryDate'       => $azphxne->first()->entryDate,
            'xLastHit'        => $azphxne->first()->xLastHit,];

         //insert if ok
         $matchThese = array('theEmail' =>$the);
         //create with newRemailAgentID
         remDistroCheck::firstOrCreate($matchThese,
         [
            'theEmail'     => $the,
            'theList'      => 'azphxne',
            'propagent_id' => $mainAccountID,
            'eidx'         => $thisEidx,
            'emailStatus'  => 'Invalid',]);}

      //  **  azphxse
      if($azphxse->count()){
         //inDistro
         $inDistro=1;
         $inList              = 'azphxse';
         $thisEidx            = $azphxse->first()->eidx;
         $thisArmlsOfficeID   = $azphxse->first()->officeID;
         $thisArmlsAgtID      = $azphxse->first()->agtMlsID;
         //details
         $distroCheck[$the]['distro']=[
            'list'            =>'azphxse',
            'eidx'            => $azphxse->first()->eidx,
            'armlsOfficeID'   => $azphxse->first()->officeID,
            'armlsAgtID'      => $azphxse->first()->agtMlsID,
            'checkDate'       => \Carbon\Carbon::now(),
            'entryDate'       => $azphxse->first()->entryDate,
            'xLastHit'        => $azphxse->first()->xLastHit,];
         //insert if ok
         $matchThese = array('theEmail' =>$the);
         //create with newRemailAgentID
         remDistroCheck::firstOrCreate($matchThese,
         [
            'theEmail'     => $the,
            'theList'      => 'azphxse',
            'propagent_id' => $mainAccountID,
            'eidx'         => $thisEidx,
            'emailStatus'  => 'Invalid',]);}

      //  **  azphxwv
      if($azphxwv->count()){
         //inDistro
         $inDistro=1;
         $inList              = 'azphxwv';
         $thisEidx            = $azphxwv->first()->eidx;
         $thisArmlsOfficeID   = $azphxwv->first()->officeID;
         $thisArmlsAgtID      = $azphxwv->first()->agtMlsID;
         //details
         $distroCheck[$the]['distro']['details']=[
            'list'            =>'azphxwv',
            'eidx'            => $azphxwv->first()->eidx,
            'armlsOfficeID'   => $azphxwv->first()->officeID,
            'armlsAgtID'      => $azphxwv->first()->agtMlsID,
            'checkDate'       => \Carbon\Carbon::now(),
            'entryDate'       => $azphxwv->first()->entryDate,
            'xLastHit'        => $azphxwv->first()->xLastHit,];
         //insert if ok
         $matchThese = array('theEmail' =>$the);
         //create with newRemailAgentID
         remDistroCheck::firstOrCreate($matchThese,
         [
            'theEmail'     => $the,
            'theList'      => 'azphxwv',
            'propagent_id' => $mainAccountID,
            'eidx'         => $thisEidx,
            'emailStatus'  => 'Invalid',]);}

      //  **  aznaz
      if($aznaz->count()){
         //inDistro
         $inDistro=1;
         $inList              = 'aznaz';
         $thisEidx            = $aznaz->first()->eidx;
         $thisArmlsOfficeID   = $aznaz->first()->officeID;
         $thisArmlsAgtID      = $aznaz->first()->agtMlsID;
         //details
         $distroCheck[$the]['distro']['details']=[
            'list'            => 'aznaz',
            'eidx'            => $aznaz->first()->eidx,
            'armlsOfficeID'   => $aznaz->first()->officeID,
            'armlsAgtID'      => $aznaz->first()->agtMlsID,
            'checkDate'       => \Carbon\Carbon::now(),
            'entryDate'       => $aznaz->first()->entryDate,
            'xLastHit'        => $aznaz->first()->xLastHit,];

         //insert if ok
         $matchThese = array('theEmail' =>$the);
         //create with newRemailAgentID
         remDistroCheck::firstOrCreate($matchThese,
         [
            'theEmail'     => $the,
            'theList'      => 'azphxwv',
            'propagent_id' => $mainAccountID,
            'eidx'         => $thisEidx,
            'emailStatus'  => 'Invalid',]);}

      //  **  azsaz
      if($azsaz->count()){
         //inDistro
         $inDistro=1;
         $inList              = 'azsaz';
         $thisEidx            = $azsaz->first()->eidx;
         $thisArmlsOfficeID   = $azsaz->first()->officeID;
         $thisArmlsAgtID      = $azsaz->first()->agtMlsID;
         //details
         $distroCheck[$the]['distro']['details']=[
            'list'            => 'azsaz',
            'eidx'            => $azsaz->first()->eidx,
            'armlsOfficeID'   => $azsaz->first()->officeID,
            'armlsAgtID'      => $azsaz->first()->agtMlsID,
            'checkDate'       => \Carbon\Carbon::now(),
            'entryDate'       => $azsaz->first()->entryDate,
            'xLastHit'        => $azsaz->first()->xLastHit,];
         //insert if ok
         $matchThese = array('theEmail' =>$the);
         //create with newRemailAgentID
         remDistroCheck::firstOrCreate($matchThese,
         [
            'theEmail'     => $the,
            'theList'      => 'azphxwv',
            'propagent_id' => $mainAccountID,
            'eidx'         => $thisEidx,
            'emailStatus'  => 'Invalid',]);}

      //valid email not in distro
      if(!$inDistro){
         $distroCheck[$the]['distro']['error']['add']=$the;
         //insert if ok
         $matchThese = array('theEmail'=>$the);
         //create with newRemailAgentID
         remDistroCheck::firstOrCreate($matchThese,
         [
            'theEmail'     => $the,
            'theList'      => 'none',
            'propagent_id' => $mainAccountID,
            'eidx'         => 'none',
            'emailStatus'  => 'Invalid',]);}}}
