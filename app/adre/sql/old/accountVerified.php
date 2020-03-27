<?php

//model
use App\models\core\agtoffice;
//update
agtoffice::where('propagent_id','=',"$mainAccountID")
->update([
   'agentConfirmDelete'=>0,
   'officeConfirmDelete'=>0,
   'agentDeleteReason'=>null,
   'officeDeleteReason'=>null,
   'agentClear'=>\Carbon\Carbon::now(),
   'officeClear'=>\Carbon\Carbon::now(),]);
