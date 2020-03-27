<?php
namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//models
use App\models\core\propoffice;
use App\models\core\agtoffice;

class officeRosterEditController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function officeEditPost(){
      //check officeID
      $origOfficeID           = request('origOfficeID');
      $origArmlsOfficeID      = request('origArmlsOfficeID');
      $newOfficeID            = request('newOfficeID');
      $newArmlsOfficeID       = request('newArmlsOfficeID');
      $formType               = request('formType');
      //error if none
      if(!$origOfficeID || !$newOfficeID){
         dd('error-line26-officeRosterEditController');}

      //set variables
      $pageRefresh      = 0;
      $modalRefresh     = 0;
      $officeName       = request('newOfficeName');
      $officeAddress1   = request('newOfficeAddress1');
      $officeCity       = request('newOfficeCity');
      $officeState      = request('newOfficeState');
      $officeZip        = request('newOfficeZip');
      //update propoffice
      propoffice::where('officeID','=',"$origOfficeID")
      ->update([
         'officeID'        => $newOfficeID,
         'armlsOfficeID'   => $newArmlsOfficeID,
         'officeName'      => $officeName,
         'officeAddress1'  => $officeAddress1,
         'officeCity'      => $officeCity,
         'officeState'     => $officeState,
         'officeZip'       => $officeZip
      ]);

      if(($origOfficeID !== $newOfficeID)
      ||($origArmlsOfficeID !== $newArmlsOfficeID)){
         //send pageRefresh
         $pageRefresh=1;
         //update agtOffice
         agtoffice::where('tempOfficeID','=',"$origOfficeID")
         ->update([
            'tempOfficeID'    => $newOfficeID,
            'armlsOfficeID'   => $newArmlsOfficeID,
         ]);
         //update propoffice
         propoffice::where('officeID','=',"$origOfficeID")
         ->update([
            'officeID'        => $newOfficeID,
            'armlsOfficeID'   => $newArmlsOfficeID,
         ]);}

      if($formType=='modal'){
         $modalRefresh=1;}

      //setup results
      $idArray = array(
         'status'       => 'success',
         'origOfficeID' => $origOfficeID,
         'newOfficeID'  => $newOfficeID,
         'pageRefresh'  => $pageRefresh,
         'modalRefresh' => $modalRefresh,
      );

      //send reply
      echo json_encode($idArray);
      exit();
   }
}

   /**


      public function rosterOfficeEditPost(){
      //get officeID
      $tempOfficeID=request('tempOfficeID');
      $origOfficeID=request('origOfficeID');
      //error if none
      if(!$tempOfficeID){
         dd('error-line17-officeRosterEditController');}

      $officeName       = request('officeName');
      $officeAddress1   = request('officeAddress1');
      $officeCity       = request('officeCity');
      $officeState      = request('officeState');
      $officeZip        = request('officeZip');

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

   */
