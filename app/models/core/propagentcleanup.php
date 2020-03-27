<?php

namespace App\models\core;

class propagentcleanup extends \App\Model
{
   protected $primaryKey   = 'propagent_id';
   protected $table        = 'propagentcleanup';
   protected $dates        = ['agtPhotoCheck','agtLogoCheck','eidxCheck',
                              'agtUnameCheck','LicNumberCheck',
                              'EmployerLicNumberCheck'];

}
