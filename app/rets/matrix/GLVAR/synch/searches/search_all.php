<?php

//rets query
$theSearch = $rets->Search($searchResource, $searchClass,
	"(Matrix_Unique_ID=0+)", [
	'Format' 	=> 'COMPACT-DECODED',
	'Limit'		=> '2000', //Limit NONE causes error - Limit 2000 runs
	'Offset'	=> $offset,
	//'Select'		=> 'Matrix_Unique_ID,PublicRemarks'
]);