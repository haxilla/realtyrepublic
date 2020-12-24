 <?php

use App\autosynch\models\propflyer\propflyerOldArc;
use App\autosynch\models\propflyer\propflyerOldArc2;
use App\autosynch\models\propflyer\propflyerCurArc;
use App\autosynch\models\deletepropmeta\deletepropmetas;
use App\autosynch\models\propphoto\propphotos;
use App\autosynch\models\deletepropphoto\deletepropphotos;
use App\autosynch\models\deletepropphoto\deletepropphotoOld;

//failcount
$fail=1;
//oldMeta
$oldMeta=propflyerOldArc::where('ufid','=',$flyerID)
->select('zipDir','mlsDir')
->first();
//set zipDir & mlsDir
$oldZipDir=$oldMeta['zipDir'];
$oldMlsDir=$oldMeta['mlsDir'];

//attempt 2
if(!$oldMeta||!$oldZipDir||(!$oldMlsDir && $oldMlsDir !=0)){
    //failcount
    $fail=2;
    //query
    $oldMeta=propflyerOldArc2::where('ufid','=',$flyerID)
    ->select('zipDir','mlsDir')
    ->first();
    //set zipDir & mlsDir
    $oldZipDir=$oldMeta['zipDir'];
    $oldMlsDir=$oldMeta['mlsDir'];}

//attempt 3
if(!$oldMeta||!$oldZipDir||(!$oldMlsDir && $oldMlsDir !=0)){
    //failcount
    $fail=3;
    //query
    $oldMeta=deletepropmetas::where('propflyer_id','=',$flyerID)
    ->select('zipDir','mlsDir')
    ->first();
    //set zipDir & mlsDir
    $oldZipDir=$oldMeta['zipDir'];
    $oldMlsDir=$oldMeta['mlsDir'];}

// final fail = error 
if(!$oldMeta||!$oldZipDir||(!$oldMlsDir && $oldMlsDir !=0)){
    dd('error-line47-fixMetaFail '.$flyerID);}

// if it works on 2nd attempt
// update the archive
if($fail==2){

    //gets valid record
    $getNew=propflyerOldArc2::where('ufid','=',$the->flyerID)
    ->get();

    //error if none
    if(!$getNew){
        dd('error-line37-fixMetaFail.php');}

    //updates master archive with data
    foreach($getNew as $the2){
        //convert this record to array
        $insertThis=$the2->toArray();
        //compare against this field
        $matchThese = array('ufid' =>$flyerID);
        //update or create
        propflyerOldArc::updateOrCreate($matchThese,$insertThis);
        propflyerCurArc::updateOrCreate($matchThese,$insertThis);}

}

// fail=3 means record was found in deletes 
// that was not in regular table

if($fail==3){

    $checkThese=propphotos::where('propflyer_id','=',$flyerID)
    ->get();

    foreach($checkThese as $the){
        //set photoName
        $photoName=$the->photoName;
        //check for match
        $deleteCheck=deletepropphotos::where('photoName','=',$photoName)
        ->first();
        //error if none
        if(!$deleteCheck){

            //local
            $insertThis=$the->toArray();
            deletepropphotos::create($insertThis);

            //remote
            $matchThese = array('locname' =>$photoName);
            deletepropphotoOld::updateOrCreate($matchThese,[
                'ufid'      =>$flyerID,
                'umid'      =>$checkPhoto['propagent_id'],
                'resized'   =>$checkPhoto['resized'],
                'photoDate' =>$checkPhoto['photoDate'],
                'photoID'   =>$checkPhoto['photoID'],
                'locname'   =>$photoName,
            ]);
        }

        //delete record if match found
        propphotos::where('photoName','=',$photoName)
        ->delete();
    }
}