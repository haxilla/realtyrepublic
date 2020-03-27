<?php

namespace App;

use App;
use Carbon\Carbon;

class oxpropagent1 extends Model
{
    protected $dates = ['startDate','expireDate','trialDate'];
    protected $primaryKey = 'id';
    protected $fillable = array(
        'eidx',
        'agtUname',
        'xxAgtUname',
        'agtFullName',
        'agtFirst',
        'agtLast',
        'startDate',
        'agtMlsID',
        'agtWeb',
        'agtAddress1',
        'agtAddress2',
        'agtCity',
        'agtState',
        'agtZip',
        'agtMainPhone',
        'officeID',
        'trialUname',
        'trialPswd',
        'trialKey',
        'trialStatus',
        'accountType',
        'trialDate',
        'startDate',
        'passhash'
    );

    public static function deletethis($trialStatus,$trialKey){

        //deletes wont work unless done by primary key
        //match record to fetch id

        $agtDelete=propagent::
            where('trialKey','=',"$trialKey")
            ->where('trialStatus','=',"$trialStatus")
            ->firstOrFail();

        //agent Delete
        $propagent_id = $agtDelete->id;
        $agtDelete->destroy($agtDelete->id);

        //office Delete
        $officeDelete=agtoffice::
            where('propagent_id','=',"$propagent_id")
            ->firstOrFail();
            $officeDelete->destroy($officeDelete->propagent_id);

    }// END OF DELETE FUNCTION

    //***********************************************//
    //    DUPLICATE AGENT CHECK                     //
    //**********************************************//
    public static function dupAgent($trialEmail){

        //check for matches
        $dup=propagent::
            where('xxAgtUname','=',"$trialEmail")
            ->orWhere('agtUname','=',"$trialEmail")
            ->orWhere('trialUname','=',"$trialEmail")
            ->first();

        // if matches found
        // already a member
        if($dup){

            // generate keys to send back for reference
            // da=duplicate agent
            $trialKey=str_random(30);
            $trialStatus="da-".str_random(6).$dup->id.str_random(6);

            //udate agent with key to call on later
                propagent::where('xxAgtUname',"$trialEmail")
                ->orWhere('agtUname',"$trialEmail")
                ->orWhere('trialUname',"$trialEmail")
                ->update (array(
                   'trialStatus'  => $trialStatus,
                   'trialKey'     => $trialKey,
                   )
                 );

            //return results to controller
            return array(
                'theStatus'    => 'duplicate',
                'trialStatus'  => $trialStatus,
                'trialKey'     => $trialKey
            );

        }//end of if duplicate

        //*******************************************//
        //        NEW AGENT ENTRY BELOW              //
        //*******************************************//
        // generate keys to send back for reference
        // na = new agent
        $trialKey       = str_random(30);
        $trialStatus    = str_random(12);
        $trialPswd      = str_random(10);

        $newID = propagent::insertGetId(
            [
                'trialEmail'    => $trialEmail,
                'trialKey'      => $trialKey,
                'trialStatus'   => $trialStatus,
                'trialUname'    => $trialEmail,
                'trialPswd'     => $trialPswd,
                'accountType'   => 1,
                'trialDate'=>carbon::now(),
                'startDate'=>carbon::now()
            ]
        );

        $newOID = agtoffice::insertGetId(
        [
            'propagent_id'    => $newID,
        ]);

        return array(
            'theStatus'    => 'new',
            'trialStatus'  => $trialStatus,
            'trialKey'     => $trialKey,
            'trialUname'   => $trialEmail,
            'trialPswd'    => $trialPswd,
            'newID'        => $newID
        );

    }//end of dupAccount Function

    public function flyers(){
        return $this->hasMany(propflyer::class);
    }
}
