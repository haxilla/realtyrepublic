<?php

//  ** **************************
//  **   YOU ARE IN A LOOP
//  **   Current Record is $the
//  *****************************

use App\models\distro\aznaz;
use App\models\distro\azsaz;
use App\models\distro\azphxmetro;
use App\models\distro\azphxne;
use App\models\distro\azphxse;
use App\models\distro\azphxwv;
//use App\models\distro\unsubs;
//use App\models\distro\permaBounce;
//distroQueries
//azphxmetro
$azphxmetro=azphxmetro::where('agtEmail','=',"$the")
->select('entryDate','eidx','officeID','xLastHit','officeID','agtMlsID');
//azphxne
$azphxne=azphxne::where('agtEmail','=',"$the")
->select('entryDate','eidx','officeID','xLastHit','officeID','agtMlsID');
//azphxse
$azphxse=azphxse::where('agtEmail','=',"$the")
->select('entryDate','eidx','officeID','xLastHit','officeID','agtMlsID');
//azphxwv
$azphxwv=azphxwv::where('agtEmail','=',"$the")
->select('entryDate','eidx','officeID','xLastHit','officeID','agtMlsID');
//aznaz
$aznaz=aznaz::where('agtEmail','=',"$the")
->select('entryDate','eidx','officeID','xLastHit','officeID','agtMlsID');
//azsaz
$azsaz=azsaz::where('agtEmail','=',"$the")
->select('entryDate','eidx','officeID','xLastHit','officeID','agtMlsID');
