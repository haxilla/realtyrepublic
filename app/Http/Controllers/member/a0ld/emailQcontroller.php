<?php

namespace App\Http\Controllers\member\a0ld;
use Illuminate\Http\Request;
use App\Jobs\passwordResetSend;
use App\Http\Controllers\Controller;
use App\models\queues\failedJobs;
use App\models\resets\passwordReset;
use App\models\core\propagent;

class emailQcontroller extends Controller
{

  public function passwordReset(Request $request){
    $prl=request('prl');
    $prl='27b3223220b5dec1732f44f613a148af';

    if(!$prl){
      dd('error-line15-emailQcontroller');}

    $getAgent=passwordReset::select('propagent_id')
    ->where('prl','=',$prl)
    ->first();

    $umid=$getAgent['propagent_id'];

    $details=propagent::where('id','=',$umid)
    ->first();

    //
    if(!$umid){
      dd('error-line32-emailQcontroller');}

    //
    if(!$details){
      dd($umid,'error-line36-emailQcontroller');}

    // send passwordReset email
    $emailJob=(new passwordResetSend($details));

    // email job
    dispatch($emailJob)
    ->onQueue('emails');

  }



  public function failedJobs(){

    $failedJobs=failedJobs::select('id','failed_at','exception')
    ->orderBy('failed_at','desc')
    ->first();

    dd($failedJobs);

  }
}
