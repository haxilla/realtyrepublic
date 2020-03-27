<?php

//models
//flyer
use App\models\oldsite\oldRemailflyerdelete;
use App\models\delete\newRemailflyerdelete;
//style
use App\models\oldsite\oldRemailstyledelete;
use App\models\delete\newRemailstyledelete;
//photos
use App\models\oldsite\oldRemailphotodelete;
use App\models\delete\newRemailphotodelete;

// ****************
// **  queries
// ****************

//  flyer
$oldFlyerDelete = oldRemailflyerdelete::whereNull('test_remarks')
->get();
//  style
$oldStyleDelete=oldRemailstyledelete::whereNull('moved')
->get();
//  photos
$oldPhotoDelete=oldRemailphotodelete::whereNull('deleteDate')
->get();

// ***************
// **  loops
// ***************

// flyer
foreach($oldFlyerDelete as $the){
  //convert this record to array
  $insertThis=$the->toArray();
  //compare against this field
  $matchThese = array('ufid' =>$the->ufid);
  //update or create
  newRemailflyerdelete::updateOrCreate($matchThese,$insertThis);
  //mark as done on old server
  oldRemailflyerdelete::where('ufid','=',$the->ufid)
  update([
    'test_remarks'=>'moved',
  ]);
}

// style
foreach($oldStyleDelete as $the){
  //convert this record to array
  $insertThis=$the->toArray();
  //compare against this field
  $matchThese = array('ufid' =>$the->ufid);
  //update or create
  newRemailstyledelete::updateOrCreate($matchThese,$insertThis);
  //mark as done on old server
  oldRemailstyledelete::where('ufid','=',$the->ufid)
  update([
    'moved'=>1,
  ]);
}

// photos
foreach($oldPhotoDelete as $the){
  //convert this record to array
  $insertThis=$the->toArray();
  //compare against this field
  $matchThese = array('photoID' =>$the->photoID);
  //update or create
  newRemailstyledelete::updateOrCreate($matchThese,$insertThis);
  //mark as done on old server
  oldRemailstyledelete::where('photoID','=',$the->photoID)
  update([
    'deleteDate'=>\Carbon\Carbon::now(),
  ]);
}
