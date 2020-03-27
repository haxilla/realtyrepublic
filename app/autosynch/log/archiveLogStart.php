<?php

Use App\models\synch\synchLog;

//update tableArchive
synchLog::where('synchID','=',$synchID)
->update([
  'tableArchive'    	=> 1,
  'tableArchiveName'	=> "$tableArchive",
  'progressMessage' 	=> "Adding Archives",
]);