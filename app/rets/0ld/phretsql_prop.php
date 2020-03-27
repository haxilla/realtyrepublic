<?php

require_once('includes/login.php');
require_once('function/create_table_sql_from_metadata.php');

// getting system meta data
$system = $rets->GetSystemMetadata();

// list of available resources
$resources = $system->getResources();

// array of available property types
$classes = $rets->GetClassesMetadata('Property');

// manually setting resouce and class (class = Property Type)
$resource = "Property";
$class = "Listing";

$table_name = "rets_".strtolower($resource)."_".strtolower($class);
$fields = $rets->GetTableMetadata($resource,$class);

$sql = create_table_sql_from_metadata('GLVARhomes2', $fields, "Matrix_Unique_ID");
\DB::connection('rets')->statement($sql);