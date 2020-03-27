<?php

use App\models\core\propagent;

//3=purchase time
//5=purchase rush credits
if($thisPurchase=='3'){

        //add time
        propagent::where('id','=',"$umid")
        ->update([
          'expireDate'=>$newExpireDate,
        ]);

        //send new expiry date email
        $theSubject="RealtyEmails Renewal Fee Received' - $desc";
        $data=[
          'desc'          => $desc,
          'newExpireDate' => $newExpireDate,
          'agtFirst'      => $agtFirst,
        ];

        \Mail::send('emails.purchases.unlimitedRenewal',$data,
          function($message)
          use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
          $message->to($toEmail,$toName)
          ->from($fromEmail,$fromName)
          ->subject($theSubject);
        });


}elseif($thisPurchase=='5'){

        //add pCred
        propagent::where('id','=',"$umid")
        ->update([
          'pCred'=>$updatePcreds,
        ]);

        //send pCreds added email
        $theSubject="RealtyEmails Rush Credits Purchased - $desc";
        $data=[
          'desc'            => $desc,
          'currentPcreds'   => $currentPcreds,
          'updatePcreds'    => $updatePcreds,
          'agtFirst'        => $agtFirst,
        ];

        \Mail::send('emails.purchases.addRushCredits',$data,
        function($message)
            use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
            $message->to($toEmail,$toName)
            ->from($fromEmail,$fromName)
            ->subject($theSubject);
        });

}else{

      //send admin error email
      //purchase is neither 3 or 5
      $data=[
      'errorMessage'=>

      'error with Purchase Type -
      check line 363 mdbxIPNsimple -
      Account Type 2 or 3',];

      $theSubject='Error with Purchase Type';
      include('paypalAdminError.php');

}
