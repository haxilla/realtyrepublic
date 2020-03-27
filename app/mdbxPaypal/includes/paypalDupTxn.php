<?php
use App\models\core\allorder;

$txnCheck=allorder::where('txn_id','=',"$txn_id")
->first();
if($txnCheck){
   //if its 1 its ok to update
   //no error message needed
   if($txnCheck['redirect']=='1'){
      //set redirect back to 0
      allorder::where('txn_id','=',"$txn_id")
      ->update([
         'redirect'        =>0,
         'receipt_id'      =>$receipt_id,
         'receiver_id'     =>$receiver_id,
         'receiver_email'  =>$receiver_email,
         'test_ipn'        =>$test_ipn,
      ]);
      //end process - what to do here?
      header("HTTP/1.1 200 OK");
      exit();
   }else{
      // send error message to admin
      // already processed before
      $data=[
      'errorMessage'=>'DUPLICATE TXN_ID - check line 65 mdbxIPNsimple',];

      $theSubject='Error with TXN_ID';
      include('paypalAdminError.php');
   }
}
