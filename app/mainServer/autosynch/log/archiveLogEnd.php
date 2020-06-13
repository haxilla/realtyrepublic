<?php

Use App\models\synch\synchLog;

synchLog::where('synchID','=',$synchID)
->update([
	'tableArchive'		=> 0,
	'tableArchiveName'	=> null,
	'progressMessage'		=> "Archive Complete",
]);
