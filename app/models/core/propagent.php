<?php

namespace App\models\core;

class propagent extends \App\Model
{
    protected $dates = ['startDate','expireDate','trialDate','lastLogin'];
    protected $primaryKey = 'id';

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
