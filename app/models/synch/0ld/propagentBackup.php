<?php

namespace App\models\synch;

class propagentBackup extends \App\Model
{
    protected $dates        = ['startDate','expireDate','trialDate'];
    protected $primaryKey   = 'id';
    protected $table        = 'propagentBackup';

    public static function agentBackupCount(){
      return static::count();
   }
}
