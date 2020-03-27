<?php

namespace App\models\delete;

// this is straight import 
// from old server

class deleteFlyerNew extends \App\Model
{
    protected $primaryKey = 'ufid';
    protected $table='deletes.remailflyerdeletes';
    public $timestamps = false;
}
