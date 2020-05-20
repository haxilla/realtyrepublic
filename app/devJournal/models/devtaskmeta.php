<?php

namespace App\devJournal\models;

class devtaskmeta extends \App\Model
{
   protected $table = 'remdev.devtaskmetas';
   protected $primaryKey='taskID';

   public function metaFields(){
      return $this->belongsTo('App\devJournal\models\devtask','taskID','taskID');
   }
}
