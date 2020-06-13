<?php

$priceChanges = DB::select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID,
		o.ListPrice as oldPrice,
		n.ListPrice as newPrice,
		o.MLSNumber as oldMLSnum,
		n.MLSNumber as newMLSnum,
		n.MatrixModifiedDT
	FROM
		rets_property_listing n
	LEFT JOIN
		rets_property_listing_arch o ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.ListPrice != n.ListPrice;
") );

$statusChanges=DB::select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID,
		o.Status as oldStatus,
		n.Status as newStatus,
		o.MLSNumber as oldMLSnum,
		n.MLSNumber as newMLSnum,
		n.MatrixModifiedDT
	FROM
		rets_property_listing n
	LEFT JOIN
		rets_property_listing_arch o ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Status != n.Status;
") );

$newListings=DB::select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID as oldID,
		n.Matrix_Unique_ID as newID,
		o.MLSNumber as oldMLSnum,
		n.MLSNumber as newMLSnum,
		n.MatrixModifiedDT
	FROM
		rets_property_listing n
	LEFT JOIN
		rets_property_listing_arch o ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE o.Matrix_Unique_ID is NULL;
") );

$removedListings=DB::select( DB::raw("
	SELECT 
		o.Matrix_Unique_ID as oldID,
		n.Matrix_Unique_ID as newID,
		o.MLSNumber as oldMLSnum,
		n.MLSNumber as newMLSnum,
		o.MatrixModifiedDT
	FROM
		rets_property_listing_arch o
	LEFT JOIN
		rets_property_listing n ON o.Matrix_Unique_ID = n.Matrix_Unique_ID
	WHERE n.Matrix_Unique_ID is NULL;
") );

dd($priceChanges,$statusChanges,$newListings,$removedListings);