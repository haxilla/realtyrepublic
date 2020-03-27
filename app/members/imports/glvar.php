<?php

Use App\models\rets\glvarListing;
//get by $mlsID
$importList=glvarListing::where('ListAgentMLSID','=',$mlsID)
->where('Status','=','Active')
->select(
	'MLSNumber','StreetNumberNumeric','StreetDirPrefix','StreetName',
	'StreetSuffix','UnitNumber','City','StateOrProvince','PostalCode',
	'Matrix_Unique_ID'
)->get();