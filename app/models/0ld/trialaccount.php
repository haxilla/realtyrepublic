<?php
namespace App;

use Carbon\Carbon;

class trialAccount extends Model
{
   //********************************************//
   // UPDATE MATCH FOUND                         // //********************************************//
   public static function autoTrialCreate
   ($trialStatus,$trialKey,$existing){

      //udate agent with matched info
      propagent::where('trialKey',"$trialKey")
      ->where('trialStatus',"$trialStatus")
         ->update (array(
            'eidx'         => $existing['eidx'],
            'agtAddress1'  => $existing['agtAddress1'],
            'agtAddress2'  => $existing['agtAddress2'],
            'agtType'      => $existing['agtType'],
            'agtCity'      => $existing['agtCity'],
            'agtFirst'     => $existing['agtFirst'],
            'agtLast'      => $existing['agtLast'],
            'agtEmail'     => $existing['agtEmail'],
            'agtFullName'  => $existing['agtFullName'],
            'agtHomePhone' => $existing['agtHomePhone'],
            'agtEmail'     => $existing['agtEmail'],
            'agtMainPhone' => $existing['agtMainPhone'],
            'agtMobile'    => $existing['agtMobile'],
            'officeID'     => $existing['officeID'],
            'agtZip'       => $existing['agtZip'],
            'agtCounty'    => $existing['agtCounty'],
            'agtWeb'       => $existing['agtWeb'],
            'agtState'     => $existing['agtState'],
            'trialDate'    => carbon::now(),
            'startDate'    => carbon::now()
         )
      );
   }//end of autoTrialCreate function
}
