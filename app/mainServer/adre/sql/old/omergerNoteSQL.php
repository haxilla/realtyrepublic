<?php
//models
Use App\models\admin\agentNote;
//set up
$mainAccountNote   = $mergerNotes[0]['mainAccountNote'];
$accountIdsMoved   = $mergerNotes[0]['accountIdsMoved'];
$flyerCountNote    = $mergerNotes[0]['flyerCountNote'];
$flyerIdsMoved     = $mergerNotes[0]['flyerIdsMoved'];
$usernameNote      = $mergerNotes[0]['usernameNote'];
$creditActiveNote  = $mergerNotes[0]['creditActiveNote'];
$agtUnameNote      = $mergerNotes[0]['agtUnameNote'];
$emailNamesMoved   = $mergerNotes[0]['emailNamesMoved'];
//emailNamesMoved
if($emailNamesMoved){
   agentNote::create([
      'propagent_id'    => $mainAccountID,
      'theNote'         => $emailNamesMoved,
   ]);}
//main Account Note
if($mainAccountNote){
   agentNote::create([
      'propagent_id'    => $mainAccountID,
      'theNote'         => $mainAccountNote,
   ]);}
//accountIdsMoved
if($accountIdsMoved){
   agentNote::create([
      'propagent_id'    => $mainAccountID,
      'theNote'         => $accountIdsMoved,
   ]);}
//flyerCountNote
if($flyerCountNote){
   agentNote::create([
      'propagent_id'    => $mainAccountID,
      'theNote'         => $flyerCountNote,
   ]);}
//flyerIdsMoved
if($flyerIdsMoved){
   agentNote::create([
      'propagent_id'    => $mainAccountID,
      'theNote'         => $flyerIdsMoved,
   ]);}
//usernameNote
if($usernameNote){
agentNote::create([
   'propagent_id'    => $mainAccountID,
   'theNote'         => $usernameNote,]);}
//agtUnameNote
if($agtUnameNote){
   agentNote::create([
      'propagent_id'    => $mainAccountID,
      'theNote'         => $agtUnameNote,
   ]);}
//creditActiveNote
if($creditActiveNote){
   agentNote::create([
      'propagent_id'    => $mainAccountID,
      'theNote'         => $creditActiveNote,
   ]);}

