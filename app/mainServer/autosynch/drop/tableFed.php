<?php

Use App\models\synch\synchLog;

//drop if exists
Schema::connection('remailsynch')
->dropIfExists($tableFed);

//update progress
synchLog::where('synchID','=',$synchID)
->update([
  'progressMessage'=>"Recreating Federated",
]);