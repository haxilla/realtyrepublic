<?php
use App\models\core\propagent;
use App\models\core\propagentmeta;
use App\models\core\propagentcleanup;
use App\models\core\agtoffice;
use App\models\core\propflyer;
use App\models\core\propphoto;
use App\models\core\propmeta;
use App\models\core\propremark;
use App\models\core\propflyerstat;
use App\models\core\propmapping;
use App\models\core\propstyle;
use App\models\admin\importableTrial;
// **** //

//agents
//delete agent records
propagent::destroy($umid);
//agentmeta
propagentmeta::destroy($umid);
//agentcleanup
propagentcleanup::destroy($umid);
//agentoffice
agtOffice::destroy($umid);
// ****  //
//flyers
//delete flyer records
propflyer::where('propagent_id','=',$umid)
->delete();
//find photoFiles & remove
include(app_path().'/functions/autoTrialDelete_photos.php');
//photo
propphoto::where('propagent_id','=',$umid)
->delete();
//meta
propmeta::where('propagent_id','=',$umid)
->delete();
//remarks
propremark::where('propagent_id','=',$umid)
->delete();
//stats
propflyerstat::where('propagent_id','=',$umid)
->delete();
//mapping
propmapping::where('propagent_id','=',$umid)
->delete();
//style
propstyle::where('propagent_id','=',$umid)
->delete();
// **** //
// trial
// delete trial record
importableTrial::where('propagent_id','=',$umid)
->delete();