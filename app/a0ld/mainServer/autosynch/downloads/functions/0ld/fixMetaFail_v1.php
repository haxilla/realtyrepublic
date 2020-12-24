 <?php

use App\autosynch\models\propflyer\propflyerOldArc;
use App\autosynch\models\propflyer\propflyerOldArc2;
use App\autosynch\models\propflyer\propflyerCurArc;

//failcount
$fail=1;
//oldMeta
$oldMeta=propflyerOldArc::where('ufid','=',$the->propflyer_id)
->select('zipDir','mlsDir')
->first();
//reset
$oldZipDir=$oldMeta['zipDir'];
$oldMlsDir=$oldMeta['mlsDir'];

if(!$oldZipDir||!$oldMlsDir){
    //failcount
    $fail=2;
    //query
    $oldMeta=propflyerOldArc2::where('ufid','=',$the->propflyer_id)
    ->select('zipDir','mlsDir')
    ->first();
    //reset
    $oldZipDir=$oldMeta['zipDir'];
    $oldMlsDir=$oldMeta['mlsDir'];}

if(!$oldZipDir||(!$oldMlsDir && $oldMlsDir!=0)){
    dd('error-line29-fixMetaFail.php '.$the->propflyer_id);}

// if it works on 2nd attempt
// update the archive
if($fail==2){

    //gets valid record
    $getNew=propflyerOldArc2::where('ufid','=',$the->propflyer_id)
    ->get();

    //error if none
    if(!$getNew){
        dd('error-line37-fixMetaFail.php');}

    //updates master archive with data
    foreach($getNew as $the2){
        //convert this record to array
        $insertThis=$the2->toArray();
        //compare against this field
        $matchThese = array('ufid' =>$the->propflyer_id);
        //update or create
        propflyerOldArc::updateOrCreate($matchThese,$insertThis);
        propflyerCurArc::updateOrCreate($matchThese,$insertThis);}

}