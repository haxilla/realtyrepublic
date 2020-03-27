<?php

namespace App;

class campaigns extends Model
{
   protected $table="propdelivs";
}

//this model is abandoned for now since
//propdeliv and propdelivnow is available
public static function completed(){

   return static::select()

}
