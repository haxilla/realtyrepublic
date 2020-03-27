<?php

use Auth;
use App\models\admin\adminTable;

$adminID=Auth::guard('admin')->user()->id;
//get authLevel
$adminInfo=adminTable::where('id','=',$adminID)
->select('authLevel')
->first();
$authLevel=$adminInfo['authLevel'];