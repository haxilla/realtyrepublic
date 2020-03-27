<?php

//defaults
namespace App\Http\Controllers;
use Illuminate\Http\Request;

//custom
use App\propagent;
use App\azphxmetro;
use App\azphxne;
use App\azphxse;
use App\azphxwv;
use App\aznaz;
use App\azsaz;
use App\trialaccount;

class trialFlyerController extends Controller
{

   public static function dupAccountCheck(){
      //set variable to form value
      $trialEmail=request('trialEmail');

      //Function below returns 'duplicate' or 'new'
      $result        = propagent::dupAgent($trialEmail);
      $theStatus     = $result['theStatus'];
      $trialKey      = $result['trialKey'];
      $trialStatus   = $result['trialStatus'];

      //**********************************//
      //           if duplicate           //
      //**********************************//
      if($theStatus=='duplicate'){

            return \Redirect::route('home', [
               //pass values back and return home
               'trialKey'     => $trialKey,
               'trialStatus'  => $trialStatus
            ]);
      }

      //******************************************
      // if new check for existing record       //
      // in distribution list                   //
      //****************************************//
      if($theStatus=='new'){

         // check all area lists
         $az1=azphxmetro::existCheck($trialEmail,$trialStatus,$trialKey);
         $az2=azphxne::existCheck($trialEmail,$trialStatus,$trialKey);
         $az3=azphxse::existCheck($trialEmail,$trialStatus,$trialKey);
         $az4=azphxwv::existCheck($trialEmail,$trialStatus,$trialKey);
         $az5=aznaz::existCheck($trialEmail,$trialStatus,$trialKey);
         $az6=azsaz::existCheck($trialEmail,$trialStatus,$trialKey);

         // if any of these set the update flag
         // notify user its been setup

         if(   $az1[0]['status']=='updated' or
               $az2[0]['status']=='updated' or
               $az3[0]['status']=='updated' or
               $az4[0]['status']=='updated' or
               $az5[0]['status']=='updated' or
               $az6[0]['status']=='updated'){

               //returing to home with na=new auto
               $trialStatus='na-'.$trialStatus;
               return \Redirect::route('home', [
                  //pass values back and return home
                  'trialKey'     => $trialKey,
                  'trialStatus'  => $trialStatus
               ]);
         }
         //******************************************//
         //  if it isnt redirected above             //
         //  it will run this code below             //
         //  nm = new manual account                 //
         //******************************************//
         $trialStatus='nm-'.$trialStatus;
         return \Redirect::route('home', [
            //pass values back and return home
            'trialKey'     => $trialKey,
            'trialStatus'  => $trialStatus
         ]);

      }//end of NEW status

   }//end of dupAccount Check

   public function trialDelete($trialStatus,$trialKey){
      //delete agent
      propagent::deletethis($trialStatus,$trialKey);
      //redirect home
      return \Redirect::route('home');
   }

}//end of class/model
