<?php

namespace App\models\core;

class propagent_v1 extends \App\Model
{
    protected $dates = ['startDate','expireDate','trialDate','lastLogin'];
    protected $primaryKey = 'id';

    public static function autoTrials(){

        $autoTrials=static::select(
            'id','created_at','agtFullName','agtUname')
        ->whereNotNull('autoTrialDate')
        ->where('accountType','=','1')
        ->get();

        return $autoTrials;
    }

    public static function autoPurchase(){
        $autoPurchase=static::select(
            'id','created_at','agtFullName','agtUname')
        ->whereNotNull('eidx')
        ->where('accountType','=','0')
        ->get();
        return $autoPurchase;
    }

    public static function passHash(){
        $passHash=static::select(
            'id','agtPswd','agtFullName')
        ->whereNull('passHash')
        ->get();
        return $passHash;
    }

    public static function synchPassHashCount(){
        return $synchPassCount=static::whereNull('passHash')->count();
    }

    public static function thisAgentCount(){
      return static::count();
    }

    public function theAgentNote(){
        return $this->hasMany('App\models\admin\agentNote','propagent_id','id');
    }

    public function theAgtOffice(){
      return $this->hasOne('App\models\core\agtoffice','propagent_id','id');
    }

    public function theAgentMeta(){
      return $this->hasOne('App\models\core\propagentmeta','propagent_id','id');
    }

    public function theAgentCleanup(){
      return $this->hasOne('App\models\core\propagentcleanup','propagent_id','id');
    }

    public function theFlyer(){
      return $this->hasMany('App\models\core\propflyer','propagent_id','id');
    }

    public function theStats(){
        return $this->hasMany('App\models\core\propflyerstat','propagent_id','id');
    }
}
