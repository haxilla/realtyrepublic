<?php

namespace App\models\delete;

// this is straight import 
// from old server

class deleteStyleNew extends \App\Model
{
    protected $primaryKey = 'ufid';
    protected $table='deletes.remailstyledeletes';
    public $timestamps = false;
}
