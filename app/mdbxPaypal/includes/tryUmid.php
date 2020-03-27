<?php
use Illuminate\Support\Facades\Crypt;

try{
    //decrypt
    $umid=Crypt::decrypt($theID);

}catch(\Exception $e){      
    //if incorrect decryption handle custom error
    //set data
    $data=[
    'errorMessage'=>
    'error-line11-tryUMID-invalid decryption',];
    // email subject
    $theSubject='Error with decryption';
    // email the error 
    include('paypalAdminError.php');
}