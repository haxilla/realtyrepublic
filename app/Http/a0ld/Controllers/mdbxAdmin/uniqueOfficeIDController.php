<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\agtoffice;
use App\models\core\propoffice;

class uniqueOfficeIDController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function uniqueOfficeID(){
      //run query
      $agtOffice=agtoffice::select('officeAddress1',
         'officeName','officeID','updated_at','propagent_id')
      ->whereNotNull('officeAddress1')
      ->whereNull('tempOfficeID')
      ->where('officeAddress1','!='," ")
      ->take(25)
      ->get();
      //show view
      return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
         'showPanel'    => 'uniqueOffice',
         'agtOffice'    => $agtOffice
      ]);
   }

   public function officeFirstSelect(){
      include(app_path().'/synch/xOfficeID/officeFirstSelect.php');
   }

   public function checkOfficeID(){
      //officeID        - original in use on realtyemails
      //xOfficeID       - new UNIQUE office ID inserted into propoffices
      //armlsOfficeID   - filled in when known to be used in armls
      //tempOfficeID    - marked when being used in div
      // ******
      //get id
      $id=request('id');
      $xOfficeID=request('xOfficeID');
      //error if none
      if(!$id||!$xOfficeID){
         dd('error-line40-uniqueOfficeIDController');}
      //run query
      $getOffice=agtoffice::select('officeID','xOfficeID',
         'tempOfficeID','armlsOfficeID','officeName','officeAddress1',
         'propagent_id')
      ->where('propagent_id','=',"$id")
      ->first();

      //does the xOfficeID exist?
      $existing=propoffice::where('officeID','=',"$xOfficeID")
      ->first();
      //error if none
      if(!$existing){
         dd("NOT EXISTING! MUST MAKE PROPOFFICE WITH $xOfficeID");}
      //update if there
      agtoffice::where('propagent_id','=',"$id")
      ->update([
         'tempOfficeID'=>$xOfficeID,
      ]);

   }
}
