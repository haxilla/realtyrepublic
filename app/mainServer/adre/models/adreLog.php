<?php

namespace App\adre\models;

class adreLog extends \App\Model
{
   protected $table        	= 'adre.ADRE_log';
   protected $primaryKey   	= 'logID';
   protected $dates      	= ['synchStart','synchEnd'];

}
