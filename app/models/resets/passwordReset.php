<?php

namespace App\models\resets;

class passwordReset extends \App\Model
{

   protected $table = 'password_resets';
   protected $dates = ['clickDate','passwordChangeDate','usernameChangeDate'];

}
