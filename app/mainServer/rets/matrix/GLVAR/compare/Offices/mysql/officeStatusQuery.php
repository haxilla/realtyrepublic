<?php

$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 		
		n.officeName			as officeName,
		n.MLSID					as officeMLSID,
		n.Matrix_Unique_ID 		as idMatrix,
		o.OfficeStatus 			as statusOld,
		n.OfficeStatus 			as statusNew,
		o.DesignatedBroker 		as DBrokerOld,
		n.DesignatedBroker 		as DBrokerNew,
		o.StreetAddress 		as officeAddressOld,
		n.StreetAddress 		as officeAddressNew,
		o.StreetCity			as officeCityOld,
		n.StreetCity			as officeCityNew,
		o.StreetPostalCode 		as officeZipOld,
		n.StreetPostalCode		as officeZipNew,
		n.StreetStateOrProvince as officeStateNew,
		o.StreetStateOrProvince	as officeStateOld,
		n.MatrixModifiedDT 		as datemodMatrix
	FROM
		$nowOffices n
	LEFT JOIN
		$oldOffices o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.OfficeStatus is not null
	AND n.OfficeStatus is not null
	AND o.OfficeStatus != n.OfficeStatus
") );

$thisTotal=collect($theQuery)->count();
$changeType="Office Status";