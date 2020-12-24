<?php

//agentNewQuery
$theQuery=DB::connection('rets')
->select( DB::raw("
	SELECT 
		n.Matrix_Unique_ID 	as idmatrixNew,
		o.Matrix_Unique_ID 	as idmatrixOld,
		n.MatrixModifiedDT 	as datemodMatrixNew,
		o.MatrixModifiedDT	as datemodMatrixOld,
		n.FirstName 		as firstName,
		n.LastName			as lastName,
		n.FullName			as fullName,
		n.LicenseNumber		as licenseNumber,
		n.Email 			as agentEmail,
		n.MLSID 			as mlsID,
		n.Office_MUI		as officeMatrix,
		n.OfficeMLSID		as officeMLSID,
		n.AgentStatus		as statusNew,
		o.AgentStatus		as statusOld,
		n.AgentType			as agentType
	FROM
		$nowAgents n
	LEFT JOIN
		$oldAgents o 
	ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Matrix_Unique_ID is NULL;
") );

$thisTotal=collect($theQuery)->count();