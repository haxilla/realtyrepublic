<?php

namespace App\models\delete;

// this is straight import 
// from old server

class deletePhotoNew extends \App\Model
{
    protected $primaryKey = 'ufid';
    protected $table='deletes.remailphotodeletes';
    public $timestamps = false;
}
