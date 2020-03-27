<?php
use App\models\core\propagent;
use App\models\core\propflyer;
use App\models\core\propphoto;
use App\models\core\propmeta;
use App\models\core\propstyle;
use App\models\core\propremark;
use App\models\core\agtoffice;

$propInfo=propflyer::where('id','=',"$idFly")
->where('propagent_id','=',"$umid")
->first();

if(!$propInfo){
   dd('error-line15-mdbxMainQueries');}

$propMetas=propmeta::select('zipDir','mlsDir')
->where('propflyer_id','=',"$idFly")
->where('propagent_id','=',"$umid")
->first();

$propRemarks=propremark::where('propflyer_id','=',"$idFly")
->where('propagent_id','=',"$umid")
->first();

$propPhotos=propphoto::select('photoName','photoID','def','orient','photoID')
->where('propflyer_id','=',"$idFly")
->where('propagent_id','=',"$umid");

$propStyles=propstyle::where('propflyer_id','=',"$idFly")
->where('propagent_id','=',"$umid")
->first();

$agentInfo=propagent::select(
   'agtPhoto',
   'agtLogo',
   'officeID',
   'agtFullName',
   'agtDesigs',
   'agtMainPhone')
->where('id','=',"$umid")
->first();

$officeInfo=agtoffice::select(
   'officeName',
   'officeAddress1',
   'officeCity',
   'officeState',
   'officeZip')
->where('officeID','=',$agentInfo['officeID'])
->first();
