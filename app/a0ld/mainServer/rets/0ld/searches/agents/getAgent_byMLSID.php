<?php

include(app_path().'/rets/includes/login.php');

$agentSearch = $rets->Search('Agent', 'Agent',
	"(MLSID=$agtMlsID)", [
	  'Format' => 'COMPACT-DECODED',
	  'Limit' => 99999999,
	  'Select' => 'Matrix_Unique_ID',
]);