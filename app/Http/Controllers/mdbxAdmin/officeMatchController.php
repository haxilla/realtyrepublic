<?php
namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class officeMatchController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function officeIdChange(){
      //get officeID
      $formOfficeID=request('tempOfficeID');
      $armlsOfficeID=request('armlsOfficeID');
      $origOfficeID=request('origOfficeID');
      //error if none
      if(!$formOfficeID){
         dd('error-line17-officeRosterEditController');}

      //set variables
      $officeName       = request('officeName');
      $officeAddress1   = request('officeAddress1');
      $officeCity       = request('officeCity');
      $officeState      = request('officeState');
      $officeZip        = request('officeZip');
      //update
      propoffice::where('officeID','=',"$origOfficeID")
      ->update([
         'officeID'        => $tempOfficeID,
         'officeName'      => $officeName,
         'officeAddress1'  => $officeAddress1,
         'officeCity'      => $officeCity,
         'officeState'     => $officeState,
         'officeZip'       => $officeZip
      ]);
      //update database
      agtOffice::where('tempOfficeID','=',"$origOfficeID")
      ->update([
         'tempOfficeID'    => $tempOfficeID,
         'officeName'      => $officeName,
         'officeAddress1'  => $officeAddress1,
         'officeCity'      => $officeCity,
         'officeState'     => $officeState,
         'officeZip'       => $officeZip
      ]);
      // if this was a tempOfficeID change
      // ALSO update oldAgent tempOfficeID
      //setup results
      $idArray = array(
         'status'       => 'success',
         'origOfficeID' => $origOfficeID,
         'newOfficeID'  => $tempOfficeID,
      );
      //send reply
      echo json_encode($idArray);
      exit();
   }

}
