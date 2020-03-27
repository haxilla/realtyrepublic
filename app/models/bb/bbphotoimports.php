<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bbphotoimports extends Model
{
   protected $connection   = 'bb';
   protected $table        = 'photoimports';
}
